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
        Commands\UpdateAction::class,
        Commands\J2::class,
        Commands\Post::class,
        Commands\PostSemaine2::class,
        Commands\DernierSemaine::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       //$schedule->command('word:day')->everyMinute();
          
              $schedule->command('word:day')->mondays()->at('07:00');
             // $schedule->command('week:day')->sundays()->at('15:30');
              //$schedule->command('stra:update')->everyMinute();//sundays()->at('23:15');
              //->everyMinute();
            $schedule->command('week:day')->fridays()->at('15:30');
            // $schedule->command('PostTeambuilding:day')->everyMinute();
            // $schedule->command('PostSemaine2Action:day')->everyMinute();
              // $schedule->command('DernierWeek:day')->everyMinute();
              //$schedule->command('j2:day')->everyMinute();
          // $schedule->command('week:day')->everyMinute();
          
          //$schedule->command('update:action')->dailyAt('08:00');
        
        
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
