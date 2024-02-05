<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Workerman\Worker;
use Workerman\Connection\AsyncTcpConnection;
use Workerman\Lib\Timer;
use App\Models\ValueCandle;
use App\Models\Currency;
use Modules\AddValues;
use function MongoDB\BSON\toJSON;


class ClientCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:startWs {start} {mode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start client server {start}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        global $argv;
        $argv[1] = $this->argument('start');
        $argv[2] = ($this->argument('mode') === 'd' ? '-d':'-g');

        $arrCurrency = [
            'ETHUSDT','BTCUSDT','DOTUSDT','AXSTRY','USDTBRL','PIVXBTC','FETTRY','HOOKUSDT','BURGERUSDT','XMRBTC','USTCBUSD','MAGICBTC','BTCDAI',
            'BETHUSDT','AGIXTRY','BCHTRY','OGNTRY','WRXUSDT','WAVESBUSD','XVSUSDT','ATMUSDT','DOGEBUSD','BNBUPUSDT','CRVBUSD','CRVUSDT'];
        $worker = new Worker();
        $worker->onWorkerStart = function()use($arrCurrency){
            $url = config('urlserver.server');
            $worker_connection = new AsyncTcpConnection($url);
            $worker_connection->transport = 'ssl';
            $worker_connection->onConnect = function($connection){
                /*$saveValueOneMinute = new Value;*/
                $saveValueCandle = new ValueCandle;
                    Timer::add(60, function() use($connection,$saveValueCandle){
                        echo "new line 1\n";
                        $saveValueCandle->createCandle("one");
                    });
                    Timer::add(300, function () use ($connection, $saveValueCandle) {
                            echo "new candle 5\n";
                            $saveValueCandle->createCandle("five");
                    });
                    Timer::add(600, function() use($connection,$saveValueCandle){
                        echo "new candle 10\n";
                        $saveValueCandle->createCandle("ten");
                    });
                    Timer::add(900, function() use($connection,$saveValueCandle){
                        echo "new candle 15\n";
                        $saveValueCandle->createCandle("fifteen");
                    });
                    Timer::add(1800, function () use ($connection, $saveValueCandle) {
                        echo "new candle 30\n delete candle 1\n";
                        $saveValueCandle->createCandle("thirty");
                    });
            };

            $worker_connection->onMessage = function($connection, $data) use($arrCurrency) {
                $res = json_decode($data, true);
                foreach ($res as $val) {
                    if (isset($val['s'])) {
                         if(in_array($val['s'],$arrCurrency)) {
                             $tmp = Currency::firstOrCreate(['name' => $val['s']]);
                             AddValues::addValueOne($tmp->id, $val['c']);
                             AddValues::addValueFive($tmp->id, $val['c']);
                             AddValues::addValueTen($tmp->id, $val['c']);
                             AddValues::addValueFifteen($tmp->id, $val['c']);
                             AddValues::addValueThirty($tmp->id, $val['c']);
                         }
                     }
                  }
            };
            $worker_connection->onError = function($connection, $code, $msg){
                echo "Error: ".$msg;
            };
            $worker_connection->onClose = function($connection){
                echo "Connection Close ";
            };
            $worker_connection->connect();
        };
       Worker::runAll();
    }
}
