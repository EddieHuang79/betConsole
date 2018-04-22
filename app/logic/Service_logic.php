<?php

namespace App\logic;

use Illuminate\Database\Eloquent\Model;
use App\model\Service;
use Illuminate\Support\Facades\Session;

class Service_logic extends Basetool
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
                      "link"          => isset($data["link"]) ? trim($data["link"]) : "",
                      "parents_id"    => isset($data["parents_id"]) ? intval($data["parents_id"]) : 0,
                      "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                      "sort"          => 0,
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
                      "link"          => isset($data["link"]) ? trim($data["link"]) : "",
                      "parents_id"    => isset($data["parents_id"]) ? intval($data["parents_id"]) : 0,
                      "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                      "updated_at"    => date("Y-m-d H:i:s")
                   );

    }

    return $result;

  }


  // 取得權限

  public static function get_service_role_auth( $data, $rel_data )
  {

    $result = array();

    $auth = array();

    if ( !empty($data) && !empty($rel_data) ) 
    {

       foreach ($rel_data as $row) 
       {

          if ( is_object($row) ) 
          {
             
             $auth[$row->service_id][] = $row->role_name;
          
          }
         
       }

       foreach ($data as $key => &$row) 
       {

          if ( is_object($row) ) 
          {

             $row->auth = isset($auth[$row->id]) ? $auth[$row->id] : array() ;

          }

       }

       $result = $data;

    }

    return $result;

  }  


  // 主選單格式

  public static function menu_format( $data )
  {

    $result = array();

    if ( !empty($data) ) 
    {

       foreach ($data as $row) 
       {

          if ( is_object($row) ) 
          {

             if ($row->parents_id == 0) 
             {
                $result[$row->id] = array(
                                  "id"     => $row->id,
                                  "name"   => $row->name,
                                  "link"   => $row->link,
                                  "child"  => array()
                               );
             }

             if ($row->parents_id > 0 && isset($result[$row->parents_id]) ) 
             {
                $result[$row->parents_id]["child"][$row->id] = array(
                                                       "id"     => $row->id,
                                                       "name"   => $row->name,
                                                       "link"   => $row->link,
                                                    );             
             }

          }

       }

    }

    return $result;

  }


  // 取的父服務名稱

  public static function get_parents_name( $data, $all_service )
  {

    $result = array();

    if ( !empty($data) && !empty($all_service) ) 
    {

       foreach ($all_service as $row) 
       {

          if ( is_object($row) ) 
          {

             $result[$row->id] = $row->name;

          }
          
       }

       foreach ($data as &$row) 
       {

          if ( is_object($row) ) 
          {
             
             $row->parents_service = $row->parents_id > 0 && isset($result[$row->parents_id]) ? $result[$row->parents_id] : "無" ;
       
          }

       }

       $result = $data;

    }

    return $result;

  } 


  // 角色權限格式

  public static function role_auth_format( $data )
  {

    $result = array();

    if ( !empty($data) ) 
    {

       foreach ($data as $key => $value)
       {

          if ( is_object($value) ) 
          {

             $result[] = $value->service_id;

          }

       }

    }

    return $result;

  }


  // 權限確認

  public static function auth_check( $service_id, $service_data )
  {

    $result = false;

    $auth_id = array();

    if ( !empty($service_id) && is_int($service_id) && !empty($service_data) && is_array($service_data) ) 
    {

       foreach ($service_data as $parents_id => $parents_data) 
       {
          
          $auth_id[] = $parents_id;

          foreach ($parents_data["child"] as $child_id => $child_data)
          {
             $auth_id[] = $child_id;
          }

       }

       $result = in_array($service_id, $auth_id) ? true : false ;

    }

    return $result;

  }


  // 取得服務

  public static function get_service( $id )
  {

    $result = new \stdClass;

    if ( !empty($id) && is_int($id) ) 
    {

       $result = Service::get_service($id);

    }

    return $result;

  }


  // 取得啟用中的服務

  public static function get_active_service()
  {

    return Service::get_active_service();

  }


  // 取得服務資料

  public static function get_service_data()
  {

    return Service::get_service_data();

  }


  // 取得服務列表

  public static function get_service_list( $param = array() )
  {

    $_this = new self();

    $option = array(
                "service_id"   => !empty($param["role_id"]) ? $_this->get_service_id_by_role(intval($param["role_id"])) : "",
                "service_name" => !empty($param["service_name"]) ? $_this->strFilter($param["service_name"]) : "",
                "status"       => !empty($param["status"]) ? intval($param["status"]) : ""
             );

    return Service::get_service_list( $option );

  }


  // 取得父服務

  public static function get_parents_service()
  {

    $result = array();

    $data = Service::get_parents_service();

    foreach ($data as $row) 
    {
    
       $result[$row->id] = $row->name;

    }

    return $result;

  }


  // 主選單

  public static function menu_list( $data )
  {

    $result = new \stdClass;

    if ( !empty($data) ) 
    {

       $result = Service::menu_list($data);

    }

    return $result;

  }


  // 新增服務

  public static function add_service( $data )
  {

    $result = false;

    if ( !empty($data) && is_array($data) && !empty($data["name"]) ) 
    {

       $result = Service::add_service( $data );
    
    }

    return $result;

  }


  // 修改服務

  public static function edit_service( $data, $service_id )
  {

    $result = false;

    if ( !empty($data) && is_array($data) && !empty($service_id) && is_int($service_id) ) 
    {

       Service::edit_service($data, $service_id);

       $result = true;
    
    }

    return $result;

  }


  // 取得該角色擁有的服務

  public static function get_service_id_by_role( $role_id )
  {

    $result = array();

    if ( !empty($role_id) && is_int($role_id) ) 
    {

       $data = Service::get_service_id_by_role( $role_id );

       foreach ($data as $row) 
       {

          if (is_object($row)) 
          {

             $result[] = $row->service_id;

          }
       
       }

    }

    return $result;

  }


  // 以網址取得服務

  public static function get_service_id_by_url_and_save( $url )
  {

    $result = false;

    if ( !empty($url) ) 
    {

       $url = "/".$url;

       $service_id = Service::get_service_id_by_url_and_save( $url )
                               ->mapWithKeys(function ($item) {
                                   return [$item->id];
                               });

       Session::put("service_id", $service_id[0]);
    
       $result = true;

    }

    return $result;

  }


  // 取得未發佈的服務

  public static function get_unpublic_service_data()
  {

    return Service::get_unpublic_service_data();

  }


  // 發布服務

  public static function public_service( $data )
  {

    $result = false;

    if ( !empty($data) && is_array($data) ) 
    {

       $service_id = intval($data["service_id"]);

       $data = array(
                   "public" => 1
                );

       Service::edit_service($data, $service_id);

       $result = true;

    }

    return $result;

  }


  // 麵包屑

  public static function breadcrumb( $service_id, $service_data )
  {

    $result = array();

    $child_parents = array();

    $targer_parents_id = 0 ;

    if ( !empty($service_id) && is_int($service_id) && !empty($service_data) && is_array($service_data) ) 
    {

       foreach ($service_data as $parents_id => $parents_data) 
       {
          
          foreach ($parents_data["child"] as $child_id => $child_data)
          {

             $child_parents[$parents_id][] = $child_id;
          
          }

       }

       foreach ($child_parents as $parents_id => $child) 
       {

          if ( in_array($service_id, $child) ) 
          {

             $targer_parents_id = $parents_id;

          }

       }

       if ( $targer_parents_id > 0 ) 
       {

          $result[] = array(
                         "name" => $service_data[$targer_parents_id]["name"],
                         "link" => $service_data[$targer_parents_id]["link"]
                      );

          $result[] = array(
                         "name" => $service_data[$targer_parents_id]["child"][$service_id]["name"],
                         "link" => $service_data[$targer_parents_id]["child"][$service_id]["link"]
                      );

       }

    }

    return $result;

  }


  // 組合列表資料

  public static function service_list_data_bind( $OriData )
  {

    $_this = new self();

    $txt = Web_cht::get_txt();

    $result = array(
                   "title" => array(
                               $txt['service_name'],
                               $txt['link'],
                               $txt['parents_service'],
                               $txt['auth'],
                               $txt['status'],
                               $txt['sort'],
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
                                  "role_name"                => $row->name,
                                  "link"                     => $row->link,
                                  "parents_service"          => $row->parents_service,
                                  "auth"                     => $row->auth,
                                  "status"                   => isset( $status_txt[$row->status] ) ? $status_txt[$row->status] : "",
                                  "sort"                     => $row->sort
                               ),
                      "Editlink" => "/service/" . $row->id . "/edit?"
                   );
             
          }

          $result["data"][] = $data;
       
       }


    }

    return $result;

  }


  // 取得輸入邏輯陣列

  public static function get_service_input_template_array()
  {

    $_this = new self();

    $txt = Web_cht::get_txt();

    $parents_service = $_this->get_parents_service();

    $role_list = Role_logic::get_active_role();

    $role_list = Role_logic::filter_admin_role($role_list);

    $htmlData = array(
                   "service_name" => array(
                       "type"          => 1, 
                       "title"         => $txt["service_name"],
                       "key"           => "name",
                       "value"         => "" ,
                       "display"       => true,
                       "desc"          => "",
                       "attrClass"     => "",
                       "hasPlugin"     => "",
                       "placeholder"   => $txt["service_name_input"]
                   ),
                   "link" => array(
                       "type"          => 1, 
                       "title"         => $txt["link"],
                       "key"           => "link",
                       "value"         => "",
                       "display"       => true,
                       "desc"          => "",
                       "attrClass"     => "",
                       "hasPlugin"     => "",
                       "placeholder"   => $txt["link_input"],
                       "required"      => false
                   ),
                   "parents_service" => array(
                       "type"          => 2, 
                       "title"         => $txt["parents_service"],
                       "key"           => "parents_id",
                       "value"         => "",
                       "data"          => $parents_service,
                       "display"       => true,
                       "desc"          => "",
                       "EventFunc"     => "",
                       "attrClass"     => "",
                       "hasPlugin"     => "",
                       "placeholder"   => "",
                       "required"      => false
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
                      "display"       => true,
                      "desc"          => "",
                      "attrClass"     => "",
                      "hasPlugin"     => "",
                      "data"          => array(
                                            1 => $txt["enable"],
                                            2 => $txt["disable"]
                                          ),
                   )
               );

    return $htmlData;

  }


  // 組合資料

  public static function service_input_data_bind( $htmlData, $OriData )
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

       $role_service = Role_logic::get_role_service( 0, $OriData["id"] );

       $auth = array();

       foreach ($role_service as $key => $value) 
       {
       
          $auth[] = $key;

       }

       $htmlData["parents_service"]["value"] = !empty($OriData["parents_id"]) ? $OriData["parents_id"] : "" ;

       $htmlData["auth"]["value"] = $auth;

       $htmlData["status"]["value"] = $OriData["status"];

    }

    return $htmlData;

  }

}
