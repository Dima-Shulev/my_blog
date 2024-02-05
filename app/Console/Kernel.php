<?php

namespace App\Console;

use App\Models\ValueCandle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Redis;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('command:valueOne')->everyFiveMinutes();
        $schedule->command('command:valueFive')->cron('30 */2 * * * *');;
        $schedule->command('command:valueTen')->cron('0 */5 * * * *');
        $schedule->command('command:valueFifteen')->cron('0 */7,5 * * * *');
        $schedule->command('command:valueThirty')->cron('0 */14 * * * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
