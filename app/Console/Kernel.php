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
        //
        Commands\WordOfTheDay::class,
        Commands\WeekDay::class,
        Commands\Stra::class,
        Commands\Intervient::class,
        Commands\PerformanceMois::class,
        Commands\PerformanceSemaine::class,
        Commands\PerformanceSemaineSN::class,
        Commands\PerformanceSemaineBF::class,
        Commands\Superieur::class,
        Commands\Desarchiver::class,
        Commands\Recap::class,
        Commands\UpdateAction::class,
        // Commands\J2::class,
        Commands\RappelStatut::class,
        Commands\MoinsDeuxDay::class,
        Commands\Odata::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

              $schedule->command('desarchiver:opportunite')->everyMinute();
              $schedule->command('Deux:Jours')->at('10:00');
              $schedule->command('performance:update')->lastDayOfMonth('22:00');
              $schedule->command('performance:semaine')->weekly()->at('18:00');
              $schedule->command('performanceSN:semaine')->weekly()->at('18:00');
              $schedule->command('performanceBF:semaine')->weekly()->at('18:00');
              $schedule->command('superieur:update')->everyMinute();
              $schedule->command('odata:c')->everyMinute();
              $schedule->command('recap:day')->weekly()->at('07:00');


        
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
