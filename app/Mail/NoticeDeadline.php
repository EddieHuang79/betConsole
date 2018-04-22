<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logic\Web_cht;

class NoticeDeadline extends Mailable
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

        $user = $this->init_data;

        $txt = Web_cht::get_txt();

        $data = ['user' => $user, 'txt' => $txt];

        $subject = "提醒您!  " . $txt["Site"] . "免費體驗即將到期!!";

        $send_template = "edm.edm_register_template2";

        return $this->from('gogocoo@gogocoo.com')
                    ->subject( $subject )
                    ->view($send_template, $data);
    
    }

}