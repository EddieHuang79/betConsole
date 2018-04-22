<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Session;

class ForgetPassword_notice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $password = Session::get("new_pwd");

        $data = ['password' => $password];

        return $this->from('gogocoo@gogocoo.com')
                    ->subject('密碼補發')
                    ->view('auth.ForgetPasswordMail', $data);
    }
}
