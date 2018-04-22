<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\logic\Admin_user_logic;
use App\logic\Option_logic;
use App\logic\Register;
use App\logic\Verifycode;
use App\logic\Login;
use App\logic\Msg_logic;
use App\logic\Store_logic;

class RegisterController extends Controller
{

    public function index()
    {

        Verifycode::get_verify_code();

        $Verifycode = Session::get('Verifycode');

        $Verifycode_img = Session::get('Verifycode_img');

        $assign_page = "register";

        $ErrorMsg = Session::get('ErrorMsg');

        Session::forget('ErrorMsg');

        $Social_login = Session::get( 'Social_login' );

        $OriData = Session::get( 'OriData' );

        Session::forget('OriData');

        $store_type = Option_logic::get_store_data();

        return view('webbase.unlogin_content', compact("assign_page", "ErrorMsg", "Verifycode", "Verifycode_img", "Social_login", "store_type", "OriData"));

    }

    public function register_process()
    {


        Session::forget( 'Register_user' );

        Session::forget( 'Login_user' );
        
        Session::forget( 'Store' );

        // 轉格式
        
        $register_data = Register::register_format($_POST);


        // 驗證

        $ErrorMsg = Register::register_process($register_data);

        $register_data["StoreCode"] = empty( $register_data["StoreCode"] ) ? Admin_user_logic::get_rand_string() : $register_data["StoreCode"] ;


        // 成功: 寫db + 登入

        if (empty($ErrorMsg)) 
        {

            // user

            $insert_data = Admin_user_logic::insert_format( $register_data );
         
            $register_data["user_id"] = Admin_user_logic::add_user( $insert_data );

            Session::put( 'Register_user', $register_data );


            // user role add 店鋪管理者

            $data = Admin_user_logic::add_user_role_format( $register_data["user_id"], array(2) );

            Admin_user_logic::add_user_role( $data );


            // 登入

            $Session_data = Login::login_session_format( $register_data["user_id"], $register_data );

            Session::put( 'Login_user', $Session_data );
            

            // store 

            $insert_store_data = Store_logic::insert_format( $register_data );

            $store_id = Store_logic::add_store( $insert_store_data );

            Session::put( 'Store', $store_id );


            // welcome msg

            $subject = "歡迎來到GOGOCOO！";

            $content = "歡迎加入我們的團隊！";

            Msg_logic::add_normal_msg( $subject, $content, $register_data["user_id"] );


            // 判斷邀請碼

            Admin_user_logic::send_invite_code_process( $register_data["invite_code"], $register_data["user_id"], $store_id );


            // 寄送註冊信

            Register::send_register_email();

            return redirect("/register_finish");

        }        

        
        // 失敗: 寫session, 返回

        if (!empty($ErrorMsg)) 
        {

            Session::put('ErrorMsg', $ErrorMsg);

            return back()->with('ErrorMsg', $ErrorMsg);

        }   

    }


    public function register_finish()
    {

        $Register_user = Session::get('Register_user');

        $assign_page = "register_finish";

        return view('webbase.unlogin_content', compact("assign_page", "Register_user"));

    }

    public function social_process()
    {

        // 接收資料

        $data = Register::social_format( $_POST );

        // 判斷是否註冊過 是：登入 否：註冊

        $user_id = Admin_user_logic::get_user_id( $data );

        
        // 登入

        if ( $user_id > 0 ) 
        {

            $data = Login::login_format($data);
            
            $err = Login::login_verify($data);
        
        }

        // 註冊
        
        if ( $user_id <= 0 ) 
        {
        
            Session::put( 'Social_login', $data );
        
        }

        $result = array(
                        "path"  => $user_id > 0 ? "/admin_index" : "/register",
                        "error" => !empty($err) ? true : false,
                        "msg"   => !empty($err) ? $err : ""
                    );

        $result =  json_encode($result);

        return $result;

    }

}
