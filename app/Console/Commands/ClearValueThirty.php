<?php

namespace App\Console\Commands;

use App\Models\ValueCandle;
use Illuminate\Console\Command;

class ClearValueThirty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:valueThirty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old candle value status thirty';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ValueCandle::deleteCandle('thirty');
    }
}
