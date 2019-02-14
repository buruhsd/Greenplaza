<?php

namespace App\Console;

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
        App\Console\Commands\CronCheckout::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('trans:checkout')
            ->everyFiveMinutes();
        // $schedule->command('trans:packing')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:able')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:shipping')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:hotlist')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:pincode')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:iklan')
        //     ->dailyAt('20:00');
        // $schedule->command('trans:name')
        //     ->dailyAt('20:00');
        // $schedule->command('inspire')
        //          ->hourly();
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
