<?php

namespace App\Console\Commands;

use App\Mail\MailerClient;
use Illuminate\Console\Command;
use App\Mail;

class MailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Illuminate\Support\Facades\Mail::to('otv5125@gmail.com')->send(new MailerClient('otv5125@gmail.com',12345));

    }
}
