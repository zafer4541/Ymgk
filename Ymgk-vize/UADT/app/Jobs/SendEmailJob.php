<?php

namespace App\Jobs;


use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Mail;
use mysql_xdevapi\Exception;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email_list;
    protected $userSendMail;
    protected $userPassword;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_list,$userSendMail,$userPassword)
    {
        $this->email_list = $email_list;
        $this->userSendMail = $userSendMail;
        $this->userPassword=$userPassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if($this->userSendMail==="" and $this->email_list!=""){
            $mailDetail = \App\Models\Mail::get();
            foreach ($mailDetail as $mail)
            {
                $details = [
                    'title'=> $mail->title,
                    'body'=> $mail->description,
                    'document'=> $mail->document,
                ];
            }
            try {
                Mail::send('back.page.email.mailStyle', $details, function($message)use($details) {
                    $message->to($this->email_list['email'])
                        ->subject($details["title"])->attach($details["document"]);
                });
            }
            catch (Exception $msg){
                echo $msg->getMessage();
            }
        }
        else if ($this->email_list==="" and $this->userSendMail!=""){
            $password=$this->userPassword;
            $details = [
                'title'=> 'Bölgesel Dış Ticaret Hızlandırma Merkezi',
                'body'=> "Merhabalar firmanız için özel üyelik oluşturduk. Artık kolayca ihracatlara ulaşabilmek için hazırsınız.",
                'eposta'=>$this->userSendMail,
                'password'=>$password,
             ];
            try {
                Mail::send('back.page.email.mailStyle', $details, function($message)use($details) {
                    $message->to($this->userSendMail)
                        ->subject($details["title"]);
                });
            }
            catch (Exception $msg){
                echo $msg->getMessage();
            }
        }

    }
}
