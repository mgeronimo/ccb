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
        \App\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->command('inspire')
                 ->hourly();*/

        //$schedule->call('TicketController@runS')->weekdays()->twiceDaily(8, 17);
        $schedule->call('TicketController@runSLA')->weekdays()->everyMinute();
    }
}
