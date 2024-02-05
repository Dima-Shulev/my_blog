<?php

namespace App\Console\Commands;

use App\Models\ValueCandle;
use Illuminate\Console\Command;

class ClearValueOne extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:valueOne';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old candle value status one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ValueCandle::deleteCandle('one');
    }
}
