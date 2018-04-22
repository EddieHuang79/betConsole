<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\logic\Verifycode;
use App\logic\ForgotPassword;
use Illuminate\Support\Facades\Session;
use App\logic\Admin_user_logic;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {

        Verifycode::get_verify_code();

        $ErrorMsg = Session::get('ErrorMsg');

        Session::forget('ErrorMsg');

        $Verifycode_img = Session::get('Verifycode_img');

        $assign_page = "auth/forgot_password";

        return view('webbase.unlogin_content', compact("Verifycode_img", "assign_page", "ErrorMsg"));
    
    }

    public function process()
    {

        // 轉格式

        $data = ForgotPassword::password_reset_format( $_POST );

        // 驗證
        
        $ErrorMsg = ForgotPassword::password_reset_verify( $data );

        // 成功: 產生密碼 更新db 寄信 

        if (empty($ErrorMsg)) 
        {

            return redirect("/reset");

        } 


        // 失敗: 寫session, 返回

        if (!empty($ErrorMsg)) 
        {

            Session::put('ErrorMsg', $ErrorMsg);

            return back()->with('ErrorMsg', $ErrorMsg);

        }   
        
    
    }

    public function reset()
    {

        $assign_page = "auth/reset";

        return view('webbase.unlogin_content', compact("assign_page"));        

    }

}
