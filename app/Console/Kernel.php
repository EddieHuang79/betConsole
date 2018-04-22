<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\logic\Edm_logic;
use App\Mail\Edm;
use App\Mail\NoticeDeadline;
use App\Mail\RegisterMail;
use App\Mail\FirstBuyGift;
use App\Mail\InviteCode;
use Mail;
use App\logic\Ecoupon_logic;
use App\logic\Store_logic;
use App\logic\Admin_user_logic;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if ( env("APP_DEBUG") === false ) 
        {

            // EDM寄送

            if ( class_exists('App\logic\Edm_logic') ) 
            {

                $edm = Edm_logic::get_edm_to_send();

                if ( $edm->isNotEmpty() === true ) 
                {

                    $schedule->call(function () use ($edm) {

                                    foreach ($edm as $row) 
                                    {

                                        Edm_logic::change_status( array($row->id), 3 );

                                        switch ( intval($row->type) ) 
                                        {

                                            case 1:

                                                $user = json_decode($row->data, true);

                                                Mail::to( array( $user['account'] ) )->send(new RegisterMail( $user ));
                                            
                                                break;
                                            
                                            case 2:

                                                $user = json_decode($row->data);

                                                Mail::to( array( $user->account ) )->send(new NoticeDeadline( $user ));
                                            
                                                break;
                                            
                                            case 3:

                                                $user = json_decode($row->data);

                                                Mail::to( array( $user->account ) )->send(new FirstBuyGift( $user ));

                                                break;

                                            case 4:
                                            case 5:

                                                $mail_list = Edm_logic::get_send_list( $row->id );

                                                $product_data = Edm_logic::get_edm_rel_product( $row->id );

                                                foreach ($mail_list as $edmData) 
                                                {

                                                    $data = array(

                                                                "type"          => (int)$row->type,

                                                                "mail_list"     => $edmData,

                                                                "product_data"  => $product_data

                                                            );

                                                    Mail::to( array( $edmData["account"] ) )->send(new Edm( $data ));

                                                }

                                                break;

                                            case 6:

                                                $user = json_decode($row->data);

                                                Mail::to( array( $user->friend_mail ) )->send(new InviteCode( $user ));

                                                break;

                                        }

                                    }
                        
                                })->cron("* * * * *");

                }

            }


            // 免費試用到期倒數三天回召

            $schedule->call(function () {

                            $data = Admin_user_logic::get_expiring_user( $day = 27 );

                            if ( !empty($data) && $data->isNotEmpty() === true ) 
                            {

                                foreach ($data as $row) 
                                {
                                    
                                    $mail_data = Edm_logic::insert_notice_mail_format( $row );

                                    Edm_logic::add_edm( $mail_data );
                                
                                }

                            }   

                        })
                        ->cron("0 1 * * *");  


            // 折價券到期提醒

            $schedule->call(function () {

                            $user_msg = array();

                            $store_user_mapping_array = Store_logic::get_store_user_mapping_array();

                            $data = Ecoupon_logic::get_expiring_ecoupon();

                            if ( !empty($data) && is_array($data) ) 
                            {

                                foreach ($data as $row) 
                                {
                                    
                                    $user_id = isset($store_user_mapping_array[$row["store_id"]]) ? $store_user_mapping_array[$row["store_id"]] : 0 ;

                                    if ( !in_array($user_id, $user_msg) ) 
                                    {
                                        
                                        $user_msg[] = $user_id;
                                        
                                    }

                                }

                                foreach ($user_msg as $row) 
                                {

                                    // 寫入訊息

                                    $subject = "折價券即將到期";

                                    $content = "請前往[GO商城] > [財產清單]中查看！";

                                    Msg_logic::add_normal_msg( $subject, $content, $row );

                                }

                            }   

                        })
                        ->cron("0 2 * * *");  

        }         

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
