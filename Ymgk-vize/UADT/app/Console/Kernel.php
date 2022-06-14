<?php

namespace App\Console;

use App\Console\Commands\GetAllMails;
use App\Console\Commands\GetDailyNews;
use App\Console\Commands\SendMailCommand;
use App\Models\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendMailCommand::class,
        GetAllMails::class,
        GetDailyNews::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (Mail::select('timeInterval')->get()->count()!=0){
            $mailInterval=Mail::select('timeInterval')->get()->first();
            switch ($mailInterval->timeInterval){
                case ('Her pazartesi'):
                    $schedule->command('mail:send')
                        ->weeklyOn(1, '8:00');
                    break;
                case ('Her ayın birinde'):
                    $schedule->command('mail:send')
                        ->monthlyOn(1, '8:00');
                    break;
            }
        }
        $schedule->command('hour:GetAllMails')
            ->everyMinute();
        $schedule->command('command:getDailyName')
            ->dailyAt('06:00');
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
}
