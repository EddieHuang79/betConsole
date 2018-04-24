<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\logic\Login;
use App\logic\Report_logic;
use Mail;

class IndexController extends Controller
{

    public function index()
    {

        // return view('frontpage/index');

        return redirect("/login");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {

        $report = array(
                        "report1" => Report_logic::report1(),
                        "report2" => Report_logic::report2(),
                        "report3" => Report_logic::report3(),
                        "report4" => Report_logic::report4(),
                        "report5" => Report_logic::report5()
                    );

        $assign_page = "index";

        $data = compact('assign_page', 'report');

        return view('webbase/content', $data);

    }

    public function sendmail()
    {

        $name = isset($_POST['name']) ? trim($_POST['name']) : "" ;

        $email = isset($_POST['email']) ? trim($_POST['email']) : "" ;

        $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "" ;

        $msg = isset($_POST['message']) ? trim($_POST['message']) : "" ;

        if ( !empty( $name ) && !empty( $email ) && !empty( $phone ) && !empty( $msg ) ) 
        {

            $msg = explode("\r\n", $msg);

            $data = [ 'name' => $name, 'email' => $email, 'phone' => $phone, 'msg' => $msg ];

            Mail::send('frontpage.custom_mail', $data, function($message) {
                $message->to('gogocooma@gmail.com')->subject('From GoGoCoo - 客戶來信');
            });

        }

        exit();
        
    }

}
