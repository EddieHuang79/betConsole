<?php

namespace App\logic;

use App\model\Admin_user;
use Illuminate\Support\Facades\Session;
use App\logic\Shop_logic;
use App\logic\Web_cht;
use App\logic\Msg_logic;
use App\logic\Role_logic;

class Admin_user_logic extends Basetool
{

   protected $user_id;

   protected $free_user_limit = 4;

   protected $status_txt = array();

   public function __construct()
   {

      $Login_user = Session::get('Login_user');

      // user_id

      $this->user_id = $Login_user["user_id"];

      $txt = Web_cht::get_txt();

      $this->status_txt = array(
                                 1  => $txt["enable"],
                                 2  => $txt["disable"]
                              );

   }

   public static function insert_format( $data )
   {
         
         $_this = new self();

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = array(
                           "account"       => isset($data["account"]) ? trim($data["account"]) : "",
                           "password"      => isset($data["password"]) ? bcrypt($_this->strFilter($data["password"])) : "",
                           "real_name"     => isset($data["real_name"]) ? $_this->strFilter($data["real_name"]) : "",
                           "mobile"        => isset($data["mobile"]) ? $_this->strFilter($data["mobile"]) : "",
                           "parents_id"    => isset($data["parents_id"]) ? intval($data["parents_id"]) : 0,
                           "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                           "created_at"    => date("Y-m-d H:i:s"),
                           "updated_at"    => date("Y-m-d H:i:s")
                        );

         }

         return $result;

   }

   public static function update_format( $data )
   {

         $_this = new self();

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = array(
                           "real_name"     => isset($data["real_name"]) ? $_this->strFilter($data["real_name"]) : "",
                           "mobile"        => isset($data["mobile"]) ? $_this->strFilter($data["mobile"]) : "",
                           "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                           "updated_at"    => date("Y-m-d H:i:s")
                        );

            if (!empty($data["password"])) 
            {
               $result["password"] = bcrypt($_this->strFilter($data["password"]));
            }

         }

         return $result;

   }

   public static function get_user_role_auth( $data, $rel_data )
   {

         $auth = array();

         $result = array();

         if ( !empty($data) && !empty($rel_data) ) 
         {

            foreach ($rel_data as $row)
            {

               $auth[$row->user_id][] = $row->name;
            
            }

            foreach ($data as &$row) 
            {
            
               $row->auth = isset($auth[$row->id]) ? $auth[$row->id] : array() ;
            
            }

            $result = $data;

         }

         return $result;

   }  

   public static function add_user_role_format( $user_id, $data )
   {

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            foreach ($data as $key => $value)
            {
               $result[] = array(
                                 "user_id"   => intval($user_id),
                                 "role_id"   => intval($value)
                           );
            }

         }

         return $result;

   }

   public static function get_user( $id = 0 )
   {

         $result = false;

         if ( !empty($id) && is_int($id) ) 
         {

            $result = Admin_user::get_user( $id );

         }

         return $result;

   }

   public static function get_user_list( $param = array() )
   {

         $result = array();

         $_this = new self();

         $status_txt = $_this->status_txt;

         $Login_user = Session::get('Login_user');

         $option = array(
                     "account"   => !empty($param["account"]) ? $_this->strFilter($param["account"]) : "",
                     "real_name" => !empty($param["real_name"]) ? $_this->strFilter($param["real_name"]) : "",
                     "user_id"   => !empty($param["role_id"]) ?  $_this->get_user_id_by_role(intval($param["role_id"])) : "",
                     "parents_id"=> !empty($Login_user["user_id"]) ? intval($Login_user["user_id"]) : "",
                     "status"    => !empty($param["status"]) ? intval($param["status"]) : ""
                  );

         $result = Admin_user::get_user_list( $option );

         if ( $result->isNotEmpty() ) 
         {

            $user_id = array();

            foreach ($result as &$row) 
            {
            
               $row->status_txt = isset($status_txt[$row->status]) ? $status_txt[$row->status] : "" ;

            }

            // 帶出使用者角色陣列

            $user_role = $_this->get_user_role();

            $result = $_this->get_user_role_auth( $result, $user_role );

         }

         return $result;

   }

   public static function get_user_role()
   {

         return Admin_user::get_user_role();
         
   }

   public static function get_user_role_by_id( $id )
   {

         $result = array();

         if ( !empty($id) && is_int($id) ) 
         {

            $result = Admin_user::get_user_role_by_id( $id );

         }

         return $result;

   }

   public static function add_user( $data )
   {

         $result = false;

         if ( !empty($data) && is_array($data) ) 
         {

            $result = Admin_user::add_user( $data );

         }

         return $result ;
         
   }

   public static function edit_user( $data, $user_id )
   {

         $result = false;

         if ( !empty($data) && is_array($data) && !empty($user_id) && is_int($user_id) ) 
         {

            Admin_user::edit_user( $data, $user_id );

            $result = true;

         }

         return $result;
         
   }

   public static function add_user_role( $data )
   {

         $result = false;

         if ( !empty($data) && is_array($data) ) 
         {

             Admin_user::add_user_role( $data );

            $result = true;

         }

         return $result;

   }

   public static function delete_user_role( $user_id )
   {

         $result = false;

         if ( !empty($user_id) && is_int($user_id) ) 
         {

            Admin_user::delete_user_role( $user_id );

            $result = true;

         }

         return $result;
         
   }

   public static function get_user_id( $data )
   {

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = Admin_user::get_user_id( $data );

         }

         return $result;
         
   }

   public static function get_user_id_by_role( $role_id )
   {

         $result = array();

         if ( !empty($role_id) && is_int($role_id) ) 
         {

            $data = Admin_user::get_user_id_by_role( $role_id );

            if ( !empty($data) ) 
            {

               foreach ($data as $row) 
               {

                  if ( is_object($row) ) 
                  {

                     $result[] = $row->user_id;

                  }    
               
               }

            }

         }

         return $result;
         
   }

   public static function get_rand_string( $len = 3 )
   {

         $_this = new self();

         $len = is_int($len) ? $len : 3 ;

         $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

         $repeat = 1;

         while ($repeat > 0) 
         {

            $result = "";

            for ($i=0; $i < $len; $i++) 
            { 
                $result .= $string[rand(0, strlen($string)-1)];
            }

            $repeat = $_this->check_store_code_repeat( $result );

         }

         return $result;

   }


   public static function is_admin( $data )
   {

         $result = !empty($data) && is_array($data) && $data["user_id"] == 1 ? true : false;

         return $result;

   }


   public static function get_user_photo()
   {

         $result = new \stdClass();

         $Login_user = Session::get( 'Login_user' );

         if ( !empty($Login_user) ) 
         {

            $result = Admin_user::get_user_photo( $Login_user["user_id"] );

            $result->photo = !empty($result->photo) ? $result->photo : "_images/user_default.png" ;

         }

         return $result;
         
   }


   public static function edit_user_photo( $photo_upload_files )
   {

         $_this = new self();

         $result = false;

         if ( !empty($photo_upload_files) ) 
         {

            $Login_user = Session::get( 'Login_user' );

            $ori_image = $_this->get_user_image( (int)$Login_user["user_id"] );

            if ( !empty($ori_image->photo) && file_exists( $ori_image->photo ) ) 
            {

               unlink( $ori_image->photo );

            }

            $result = Admin_user::edit_user_photo( $photo_upload_files, $Login_user["user_id"] );

         }

         return $result;
         
   }


   // 回傳帳號原始圖片

   public static function get_user_image( $user_id )
   {

      $result = false;

      if ( !empty($user_id) && is_int($user_id) ) 
      {

         $result = Admin_user::get_user_image( $user_id );

      }

      return $result;
         
   }


   // 帳號驗證

   public static function account_verify( $data )
   {

      $_this = new self();

      $txt = Web_cht::get_txt();

      $result = array();

      $ErrorMsg = array();

      if ( !empty($data) && is_array($data) ) 
      {

         try 
         {

            // 密碼長度

            if ( !empty($data["password"]) && !$_this->string_length( $data["password"] ) ) 
            {
                          
               $ErrorMsg[] = $txt["pwd_length_fail"];

            }


            // 密碼複雜度

            if ( !empty($data["password"]) && !$_this->pwd_complex( $data["password"] ) ) 
            {

               $ErrorMsg[] = $txt["pwd_format_fail"];

            }


            // 手機

            if ( !$_this->is_phone( $data["mobile"] ) ) 
            {

               $ErrorMsg[] = $txt["phone_format_fail"];

            }


            // 姓名

            if ( !$_this->strFilter( $data["real_name"] ) ) 
            {

               $ErrorMsg[] = $txt["real_name_fail"];

            }


            // 角色

            if ( !isset($data["auth"]) ) 
            {

               $ErrorMsg[] = "未選擇角色！";

            }


            if ( !empty($ErrorMsg) ) 
            {

               throw new \Exception(json_encode($ErrorMsg));

            }

         } 
         catch (\Exception $e) 
         {

            $result = json_decode($e->getMessage() ,true);
         
         }

      }


      return $result;

   }


   // 取得所有關連id

   public static function get_rel_user_id( $user_id )
   {

         $result = array() ;

         if ( !empty($user_id) && is_int($user_id) )
         {

            $data = Admin_user::get_rel_user_id( $user_id );

            foreach ($data as $row) 
            {

               $result[] = $row->id;

            }

         } 

         return $result;   

   }


   // 組合列表資料

   public static function user_list_data_bind( $OriData )
   {

      $_this = new self();

      $txt = Web_cht::get_txt();

      $result = array(
                     "title" => array(
                                 $txt['account'],
                                 $txt['real_name'],
                                 $txt['telephone'],
                                 $txt['auth'],
                                 $txt['status'],
                                 $txt['action']
                              ),
                     "data" => array()
                 );

      if ( !empty($OriData) && $OriData->isNotEmpty() ) 
      {

         foreach ($OriData as $row) 
         {
   
            if ( is_object($row) ) 
            {

               $data = array(
                        "data" => array(
                                    "account"               => $row->account,
                                    "real_name"             => $row->real_name,
                                    "telephone"             => $row->mobile,
                                    "auth"                  => $row->auth ,
                                    "status"                => $row->status_txt,
                                 ),
                        "Editlink"  => "/user/" . $row->id . "/edit?"
                     );
               
            }

            $result["data"][] = $data;
         
         }


      }

      return $result;

   }


   // 取得輸入邏輯陣列

   public static function get_admin_input_template_array()
   {

      $_this = new self();

      $txt = Web_cht::get_txt();

      $role_list = Role_logic::get_active_role();

      $role_list = Role_logic::filter_admin_role($role_list);

      $htmlData = array(
                     "account" => array(
                         "type"          => 1, 
                         "title"         => $txt["account"],
                         "key"           => "account",
                         "value"         => "" ,
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => "",
                         "placeholder"   => $txt["account_input"]
                     ),
                     "password" => array(
                         "type"          => 7, 
                         "title"         => $txt["password"],
                         "key"           => "password",
                         "value"         => "",
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => "",
                         "placeholder"   => $txt["password_input"],
                         "required"      => false
                     ),
                     "real_name" => array(
                         "type"          => 1, 
                         "title"         => $txt["real_name"],
                         "key"           => "real_name",
                         "value"         => "",
                         "data"          => "",
                         "display"       => true,
                         "desc"          => "",
                         "EventFunc"     => "",
                         "attrClass"     => "",
                         "hasPlugin"     => "",
                         "placeholder"   => $txt["real_name_input"]
                     ),
                     "telephone" => array(
                         "type"          => 1, 
                         "title"         => $txt["telephone"],
                         "key"           => "mobile",
                         "value"         => "",
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => "",
                         "placeholder"   => $txt["mobile_input"]
                     ),
                     "auth" => array(
                         "type"          => 6, 
                         "title"         => $txt["auth"],
                         "key"           => "auth[]",
                         "value"         => "",
                         "data"          => $role_list,
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => ""
                     ),
                     "status" => array(
                         "type"          => 3,
                         "title"         => $txt["status"],
                         "key"           => "active",
                         "value"         => "",
                         "data"          => array(
                                             1 => $txt["enable"],
                                             2 => $txt["disable"]
                                          ),
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => ""
                     )
                 );

      return $htmlData;

   }


   // 組合資料

   public static function admin_input_data_bind( $htmlData, $OriData )
   {

      $_this = new self();

      $result = $htmlData;

      if ( !empty($OriData) && is_array($OriData) ) 
      {

         foreach ($htmlData as &$row) 
         {
         
            if ( is_array($row) ) 
            {

               $row["value"] = isset($OriData[$row["key"]]) ? $OriData[$row["key"]] : "" ;
               
            }

         }

         if ( isset($OriData["id"]) ) 
         {

            // 修正時改為純文字

            $htmlData["account"]["type"] = 5;

            // password 不顯示

            $htmlData["password"]["value"] = "";
            
         }

         // 角色

         $id = isset($OriData["id"]) ? (int)$OriData["id"] : 0 ;

         $user_role = $id > 0 ? Admin_user_logic::get_user_role_by_id( $id ) : "" ;

         $user_role = $_this->get_object_or_array_key( $user_role );

         $htmlData["auth"]["value"] = $user_role;

         // 狀態

         $htmlData["status"]["value"] = isset($OriData["status"]) ? $OriData["status"] : "" ;

      }

      return $htmlData;

   }

}