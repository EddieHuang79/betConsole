<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logic\Web_cht;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $init_data = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($init)
    {
    
        $this->init_data = $init;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $Login_user = $this->init_data;

        $txt = Web_cht::get_txt();

        $data = ['Login_user' => $Login_user, 'txt' => $txt];

        $subject = "恭喜您!  " . $txt["Site"] . "註冊成功通知";

        $send_template = "edm.edm_register_template1";

        return $this->from('gogocoo@gogocoo.com')
                    ->subject( $subject )
                    ->view($send_template, $data);

    }
}
