<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\logic\Verifycode;
use Illuminate\Support\Facades\Session;
use App\logic\Login;
use App\logic\Redis_tool;
use App\logic\Admin_user_logic;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        Session::forget( 'Social_login' );

        Verifycode::get_verify_code();

        $Verifycode = Session::get('Verifycode');

        $Verifycode_img = Session::get('Verifycode_img');

        $ErrorMsg = Session::get('ErrorMsg');

        $OriData = Session::get( 'OriData' );

        Session::forget('ErrorMsg');

        Session::forget('OriData');

        $assign_page = "login";

        return view('webbase.unlogin_content', compact("Verifycode_img", "ErrorMsg", "assign_page", "OriData"));
    
    }


    public function process()
    {

        $result = array();

        $data = Login::login_format($_POST);

        $result = Login::login_verify($data);

        return empty($result) ? redirect("/admin_index") : back()->with('ErrorMsg', $result);

    }

    public function logout()
    {

        Login::logout();

        return redirect("/login");

    }

    public function refresh()
    {

        Session::forget('Verifycode');

        Session::forget('Verifycode_img');

        Verifycode::get_verify_code();

        $Verifycode_img = Session::get('Verifycode_img');

        return $Verifycode_img;

    }


}
