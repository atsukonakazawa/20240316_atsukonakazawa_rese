<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule
        ->command('send:reminders')
        ->dailyAt('09:00')
        ->withoutOverlapping();
        //withoutOverlapping()はメールの送信自体は制御できないが、
        //競合するプロセスを回避するために役立つ。
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    //protected $commands = [
    //    Commands\SendReminders::Class,
    //];
}
