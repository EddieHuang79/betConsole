<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\logic\Web_cht;

class Edm extends Mailable
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

        $EdmData = $this->init_data;

        $txt = Web_cht::get_txt();

        switch ( $EdmData["type"] ) 
        {

            case 4:

                $subject =  "歡迎加入" . $txt["Site"] . "，好康活動!!";

                $send_template = "edm.edm_register_template4";
            
                break;
            
            case 5:

                $subject = $txt["Site"] . "新服務邀請";

                $send_template = "edm.edm_register_template5";
                
                break;
        
        }

        $data = ['mall' => $EdmData["product_data"], 'real_name' => $EdmData["mail_list"]["real_name"], 'txt' => $txt];

        return $this->from('gogocoo@gogocoo.com')
                    ->subject( $subject )
                    ->view($send_template, $data);

    }
}
