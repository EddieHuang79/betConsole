<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\logic\Login;
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

        Session::forget('service_id');

        // // 本週訂單

        // $week_order_cnt = Report_logic::this_week_order_cnt();

        // // 本週取消訂單

        // $week_cancel_order_cnt = Report_logic::week_cancel_order_cnt();

        // // 今日入庫

        // $today_in_ws_cnt = Report_logic::today_in_ws_cnt();

        // // 今日出庫

        // $today_out_ws_cnt = Report_logic::today_out_ws_cnt();

        // Report_logic::product_top5_stack();

        $assign_page = "index";

        $data = compact('assign_page');

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
