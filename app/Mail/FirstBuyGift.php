<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logic\Web_cht;
use App\logic\Mall_logic;

class FirstBuyGift extends Mailable
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

        $mall = Mall_logic::get_single_mall( 1 );

        $data = ['user' => $user, 'txt' => $txt, 'mall' => $mall];

        $subject = "歡迎加入" . $txt["Site"] . "，領取專屬您的好康禮!!";

        $send_template = "edm.edm_register_template3";

        return $this->from('gogocoo@gogocoo.com')
                    ->subject( $subject )
                    ->view($send_template, $data);

    }
}
