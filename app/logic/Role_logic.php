<?php

namespace App\logic;

use Illuminate\Database\Eloquent\Model;
use App\model\Role;
use App\logic\Redis_tool;
use Illuminate\Support\Facades\Session;
use App\logic\Web_cht;

class Role_logic extends Basetool
{

   protected $status = array();

   public function __construct()
   {

      // 文字

      $txt = Web_cht::get_txt();

      $this->status = array(
                     1  => $txt["enable"],
                     2  => $txt["disable"]
                  );

   }  

   // 新增格式

   public static function insert_format( $data )
   {
         
         $_this = new self();

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = array(
                           "name"          => isset($data["name"]) ? $_this->strFilter($data["name"]) : "",
                           "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                           "created_at"    => date("Y-m-d H:i:s"),
                           "updated_at"    => date("Y-m-d H:i:s")
                        );

         }

         return $result;

   }


   // 修改格式

   public static function update_format( $data )
   {

         $_this = new self();

         $result = array();

         if ( !empty($data) && is_array($data) ) 
         {

            $result = array(
                           "name"          => isset($data["name"]) ? $_this->strFilter($data["name"]) : "",
                           "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                           "updated_at"    => date("Y-m-d H:i:s")
                        );

         }

         return $result;

   }


   // 新增權限格式

   public static function add_role_service_format( $role_id, $service_id, $data )
   {
      
         $result = array();

         if ( !empty($data) ) 
         {

            if ( $role_id > 0 ) 
            {
               foreach ($data as $key => $value)
               {
                  $result[] = array(
                                    "role_id"      => intval($role_id),
                                    "service_id"   => intval($value)
                              );
               }
            }

            if ( $service_id > 0 ) 
            {
               foreach ($data as $key => $value)
               {
                  $result[] = array(
                                    "role_id"      => intval($value),
                                    "service_id"   => intval($service_id)
                              );
               }
            }

         }

         return $result;

   }


   // 取得角色列表

   public static function get_role_list( $param = array() )
   {

         $_this = new self();

         return Role::get_role_list( $param );

   }


   // 取得單一角色

   public static function get_role( $id )
   {

         $result = new \stdClass();

         if ( !empty($id) && is_int($id) ) 
         {

            $result = Role::get_role( $id );

         }

         return $result ;

   }


   // 取得角色權限

   public static function get_role_service( $role_id = 0, $service_id = 0 )
   {

         $result = $service_id > 0 ? Role::get_role_service($role_id, $service_id)->mapWithKeys(function ($item) {
                                  return [$item->role_id => $item->service_id];
                              }) : Role::get_role_service($role_id, $service_id) ;

         return $result;

   }


   // 取得啟用的角色

   public static function get_active_role()
   {

         // $result = Redis_tool::get_active_role();

         // if (empty($result))
         // {
            
            $result = Role::get_active_role();
            
            // Redis_tool::set_active_role( $result );
         
         // }

         return $result;

   }

   // 新增角色

   public static function add_role( $data )
   {

         $result = false;

         if ( !empty($data) && is_array($data) && !empty($data["name"]) ) 
         {

            $result = Role::add_role( $data );

         }

         return $result;

   }


   // 修改角色

   public static function edit_role( $data, $role_id )
   {

         $result = false;

         if ( !empty($data) && is_array($data) && !empty($role_id) && is_int($role_id) ) 
         {

            Role::edit_role( $data, $role_id );

            $result = true;

         }

         return $result;

   }


   // 新增權限

   public static function add_role_service( $data )
   {

         $result = false;

         if ( !empty($data) && is_array($data) ) 
         {

            Role::add_role_service( $data );

            $result = true;

         }

         return $result;

   }


   // 刪除權限

   public static function delete_role_service( $role_id = 0, $service_id = 0 )
   {

         Role::delete_role_service( $role_id, $service_id );

   }


   // 過濾管理者角色

   public static function filter_admin_role( $data )
   {

         $Login_user = Session::get('Login_user');

         $result = array();

         if ( !empty($data) && is_object($data) ) 
         {

            foreach ($data as $role_id) 
            {

               if ( (int)$Login_user["user_id"] != 1 && !in_array( $role_id->id, array( 1 ) ) || (int)$Login_user["user_id"] == 1 ) 
               {
               
                  $result[] = $role_id;
               
               }
            
            }

         }

         return $result;

   }


   // 取得角色陣列

   public static function get_role_array()
   {

         $result = array();

         $data = Role::get_role_data();

         if ( !empty($data) ) 
         {

            foreach ($data as $row) 
            {

               if ( is_object($row) ) 
               {

                  $result[$row->id] = $row->name;

               }

            }

         }

         return $result;

   }


   // 組合列表資料

   public static function role_list_data_bind( $OriData )
   {

      $_this = new self();

      $txt = Web_cht::get_txt();

      $result = array(
                     "title" => array(
                                 $txt['role_name'],
                                 $txt['status'],
                                 $txt['action']
                              ),
                     "data" => array()
                 );

      if ( !empty($OriData) && $OriData->isNotEmpty() ) 
      {

         $status_txt = $_this->status;

         foreach ($OriData as $row) 
         {
   
            if ( is_object($row) ) 
            {

               $data = array(
                        "data" => array(
                                    "role_name"          => $row->name,
                                    "status"             => isset( $status_txt[$row->status] ) ? $status_txt[$row->status] : "",
                                 ),
                        "Editlink" => "/role/" . $row->id . "/edit?"
                     );
               
            }

            $result["data"][] = $data;
         
         }


      }

      return $result;

   }


   // 取得輸入邏輯陣列

   public static function get_role_input_template_array()
   {

      $_this = new self();

      $txt = Web_cht::get_txt();

      $menu_data = Service_logic::get_active_service();

      $menu_list = Service_logic::menu_format( $menu_data );

      $htmlData = array(
                     "name" => array(
                         "type"          => 1, 
                         "title"         => $txt["role_name"],
                         "key"           => "name",
                         "value"         => "" ,
                         "display"       => true,
                         "desc"          => "",
                         "attrClass"     => "",
                         "hasPlugin"     => "",
                         "placeholder"   => $txt["role_input"]
                     ),
                     "auth" => array(
                         "type"          => 13, 
                         "title"         => $txt["auth"],
                         "key"           => "auth[]",
                         "value"         => "",
                         "data"          => $menu_list,
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

   public static function role_input_data_bind( $htmlData, $OriData )
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


         $id = isset($OriData["id"]) ? (int)$OriData["id"] : 0 ;

         $role_service_data = Role_logic::get_role_service( $id );

         $role_service = Service_logic::role_auth_format( $role_service_data );

         $htmlData["auth"]["value"] = $role_service ;


         // 狀態

         $htmlData["status"]["value"] = isset($OriData["status"]) ? $OriData["status"] : "" ;

      }

      return $htmlData;

   }

}