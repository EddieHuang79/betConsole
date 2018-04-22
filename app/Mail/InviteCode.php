<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logic\Web_cht;

class InviteCode extends Mailable
{
    use Queueable, SerializesModels;

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

        $user = $this->init_data;

        $txt = Web_cht::get_txt();

        $data = ['user' => $user, 'txt' => $txt];

        $subject = $txt["Site"] . " 註冊邀請";

        $send_template = "edm.edm_register_template6";

        return $this->from('gogocoo@gogocoo.com')
                    ->subject( $subject )
                    ->view($send_template, $data);

    }
}
