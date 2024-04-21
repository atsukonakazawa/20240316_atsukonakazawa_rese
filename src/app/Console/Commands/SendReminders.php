<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Batch;
use App\Jobs\SendReminderEmail;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to reservation users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $reservations = Reservation::whereDate('rese_date',$today)
                    ->select('user_id')
                    ->get();

        $users = collect();
        // ユーザー情報を格納するコレクションを初期化

        foreach($reservations as $reservation){
            $user = User::find($reservation->user_id);
            if ($user) {
                $users->push($user);
                // ユーザー情報をコレクションに追加
            }
        }

        $jobs = $users->map(function ($users) {
            return new SendReminderEmail($user);
        });

        if($users->isEmpty()) {

            //当日予約がなければ特に何もしない
            $this->info('No reservations for today.');
        }else{

            $batch = Batch::dispatch(...$jobs);
            $this->info('Reminder emails have been dispatched!');
        }
    }
}
