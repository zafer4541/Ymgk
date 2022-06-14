<?php

namespace App\Console\Commands;

use App\Http\Controllers\Back\MailController;
use App\Models\Mail;
use Illuminate\Console\Command;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mail Gonderimi Yapar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mailController=new MailController();
        $mailController->sendMail();
    }
}
