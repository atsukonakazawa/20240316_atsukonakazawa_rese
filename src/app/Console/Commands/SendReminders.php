<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminders';

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

        // 今日の日付を取得
        $today = Carbon::today();

        // 今日の日付に該当する予約レコードを取得
        $reservations = Reservation::whereDate('rese_date', $today)->get();

        // 予約が存在するかチェック
        if ($reservations->isEmpty()) {
            $this->info('There is no reservation today.');
            return;
        }

        foreach ($reservations as $reservation) {
            // 予約者のユーザー情報を取得
            $user = User::find($reservation->user_id);
            $shop = Shop::find($reservation->shop_id);

            // 予約内容を含めたリマインダーメールを送信
            $messageBody = $user->name . "さま </br>";
            $messageBody .= " <br>";
            $messageBody .= "ご予約日となりましたのでお知らせいたします。 </br>";
            $messageBody .= " <br>";
            $messageBody .= "【ご予約内容】 <br>";
            $messageBody .= " 店舗名: " . $shop->shop_name . "<br>";
            $messageBody .= " 日付: " . $reservation->rese_date . "<br>";
            $messageBody .= " 時間: " . $reservation->rese_time . "<br>";
            $messageBody .= " 人数: " . $reservation->rese_people . "<br>";
            $messageBody .= " <br>";
            $messageBody .= " ご来店の際に以下のQRコードをご提示ください。<br>";
            $messageBody .= QrCode::generate($user->name) . "<br>";
            $messageBody .= " 万が一ご都合が悪くなってしまった場合は、お気軽にご連絡ください。 <br>";
            $messageBody .= " ご来店を心よりお待ちしております。 <br>";
            $messageBody .= " <br>";
            $messageBody .= " Reseグループ " . $shop->shop_name . " スタッフ一同 <br>";

            Mail::send([], [], function ($message) use ($user, $messageBody) {
                $message->to($user->email)
                        ->subject('ご予約内容のお知らせ')
                        ->setBody($messageBody, 'text/html');
            });


            $this->info('Reminders sent successfully.');
        }
    }
}