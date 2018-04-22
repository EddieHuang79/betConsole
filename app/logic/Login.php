<?php

namespace App\logic;

use App\logic\Admin_user_logic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\logic\Verifycode;
use App\logic\Web_cht;
use App\logic\Store_logic;

class Login extends Basetool
{

   public static function login_format( $data )
   {
         
         $_this = new self();

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = array(
                           "account"       => isset($data["email"]) && !empty($data["email"]) ? trim($data["email"]) : "",
                           "password"      => isset($data["pwd"]) && !empty($data["pwd"]) ? $_this->strFilter($data["pwd"]) : "",
                           "verify_code"   => isset($data["verify"]) && !empty($data["verify"]) ? intval($data["verify"]) : 0,
                           "social"        => isset($data["social"]) && !empty($data["social"]) ? intval($data["social"]) : 0,
                           "token"         => isset($data["_token"]) && !empty($data["_token"]) ? $_this->strFilter($data["_token"]) : "",
                           "created_at"    => date("Y-m-d H:i:s")
                        );

         }

         return $result;

   }


   public static function login_verify( $data )
   {

         $_this = new self();

         $txt = Web_cht::get_txt();

         $result = "";

         $error_msg = array();
         
         if ( !empty($data) && is_array($data) ) 
         {

            try{

               $user_id = Admin_user_logic::get_user_id( $data );

               if (empty($user_id))
               {

                  $error_msg[] = $txt["accont_error"];

                  throw new \Exception(json_encode($error_msg));
               }

               $user_data = Admin_user_logic::get_user( $user_id );

               $compare = Hash::check( $data["password"], $user_data->password );

               if (!$compare) 
               {

                  $error_msg[] = $txt["pwd_error"];
               
               }

               if ( empty($data["social"]) ) 
               {

                  $compare = Verifycode::auth_verify_code( $data["verify_code"] );
         
                  if (!$compare) 
                  {
                  
                     $error_msg[] = $txt["verify_code_error"];
                     
                  } 

               }


               // 錯誤處理

               if (!empty($error_msg)) 
               {

                  throw new \Exception(json_encode($error_msg));
               
               }

               $data["real_name"] = $user_data->real_name;

               Session::forget('ErrorMsg');

               $Session_data = Login::login_session_format( $user_id, $data );

               Session::put( 'Login_user', $Session_data );

               $store_info = Store_logic::get_store_info();

               $store_info = $store_info[0];

               Session::put( 'Store', $store_info->id );

               // 發送折價券

               Ecoupon_logic::send_ecoupon( $send_type = 1, (int)$user_id );

            }
            catch(\Exception $e)
            {

               Session::put( 'OriData', $data );

               $result = $_this->show_error_to_user( json_decode($e->getMessage() ,true) );

            }

         }

         return $result;

   }


   // session寫入格式

   public static function login_session_format( $user_id, $user_data )
   {
         
         $_this = new self();

         $result = array();

         if ( !empty($user_id) && is_int($user_id) && !empty($user_data) && is_array($user_data) ) 
         {

            $result = array(
                           "user_id"       => isset($user_id) ? $user_id : 0,
                           "account"       => isset($user_data["account"]) ? $user_data["account"] : "",
                           "real_name"     => isset($user_data["real_name"]) ? $user_data["real_name"] : "",
                           "token"         => isset($user_data["token"]) ? $user_data["token"] : "",
                           "time"          => isset($user_data["created_at"]) ? strtotime($user_data["created_at"]) : time()
                        );

         }

         return $result;

   }


   // 判斷是否登入

   public static function is_user_login()
   {
         
         $Login_user = Session::get('Login_user');

         $result = empty($Login_user["user_id"]) ? false : true ;
         $result = empty($Login_user["account"]) ? false : $result ;
         $result = empty($Login_user["real_name"]) ? false : $result ;
         $result = empty($Login_user["token"]) ? false : $result ;
         $result = empty($Login_user["time"]) ? false : $result ;

         return $result;

   }


   // 取得session使用者資料

   public static function get_login_user_data()
   {
         
         $Login_user = Session::get('Login_user');

         return $Login_user;

   }


   // 登出

   public static function logout()
   {
         
         Session::forget('Login_user');
         
         Session::forget('Store');

   }


}