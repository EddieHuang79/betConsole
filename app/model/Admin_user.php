<?php

namespace App\model;

use Illuminate\Support\Facades\DB;
use App\logic\Redis_tool;

class Admin_user
{

   protected $table = 'user';

   protected $user_role = 'user_role_relation';

   protected $role = 'role';

   protected $store = 'store';

   protected $invite_record = 'invite_record';


   public static function get_user_list( $option = array(), $page_size = 15 )
   {

   		$_this = new self;

         $user = DB::table($_this->table);
         $user = !empty($option["account"]) ? $user->where("account", "like", "%".$option["account"]."%") : $user ;
         $user = !empty($option["real_name"]) ? $user->where("real_name", "like", "%".$option["real_name"]."%") : $user ;
         $user = !empty($option["status"]) ? $user->where("status", "=", $option["status"]) : $user ;
         $user = !empty($option["user_id"]) ? $user->whereIn("id", $option["user_id"]) : $user ;
         $user = !empty($option["parents_id"]) ? $user->where("id", $option["parents_id"])->orWhere("parents_id", $option["parents_id"]) : $user ;
   		$user = $user->orderBy("updated_at", "desc")->paginate($page_size);

   		return $user;

   }

   public static function get_user( $id = 0 )
   {

         $_this = new self;
      
         $user = DB::table($_this->table)->find($id);

         return $user;

   }

   public static function get_user_data()
   {

         $_this = new self;
      
         $user = DB::table($_this->table)->get();

         return $user;

   }

   public static function get_active_user()
   {

      $_this = new self();

      $data = DB::table($_this->table)->where("status", "=", "1")->get();

      return $data;

   }

   public static function add_user( $data )
   {

         $_this = new self;
      
         $user_id = DB::table($_this->table)->insertGetId($data);

         return $user_id;

   }

   public static function edit_user( $data, $where )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->where('id', $where)->update($data);

         return $result;

   }

   public static function get_user_role_by_id( $id )
   {

         $_this = new self;
      
         $user_role = Redis_tool::get_user_role( $id );

         $select_db = empty($user_role) ? 1 : 0 ;

         $user_role = $select_db == 0 ? $user_role :
                     DB::table($_this->user_role)
                     ->leftJoin($_this->role, 'user_role_relation.role_id', '=', 'role.id')
                     ->select('user_role_relation.id', 'user_role_relation.role_id', 'role.name')
                     ->where("user_role_relation.user_id", "=", $id)
                     ->where($_this->role.".status", "=", 1)
                     ->orderBy($_this->role.'.id')
                     ->get()->mapWithKeys(function ($item) {
                                  return [$item->role_id => $item->name];
                              });
         
         $select_db == 1 ? Redis_tool::set_user_role($user_role, $id) : "" ;

         return $user_role;

   }

   public static function get_user_role( $option = array() )
   {

   		$_this = new self;
   	
         $user_role = DB::table($_this->user_role)
                     ->leftJoin($_this->role, 'user_role_relation.role_id', '=', 'role.id')
                     ->select('user_role_relation.id', 'user_role_relation.user_id', 'user_role_relation.role_id', 'role.name')
                     ->where($_this->role.".status", "=", 1)
                     ->get();

   		return $user_role;

   }

   public static function add_user_role( $data )
   {

         $_this = new self;
      
         $result = DB::table($_this->user_role)->insert($data);

         return $result;

   }

   public static function delete_user_role( $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->user_role)->where('user_id', '=', $user_id)->delete();

         return $result;

   }

   public static function get_user_id( $data )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->where('account', '=', $data["account"])->first();

         $result = !empty($result->id) ? $result->id : 0 ; 

         return $result;

   }

   public static function get_user_id_by_role( $role_id )
   {

         $_this = new self;
      
         $user = DB::table($_this->user_role)->select('user_id')->where('role_id', '=', $role_id)->groupBy('user_id')->get();

         return $user;

   }

   public static function check_store_code_repeat( $store_code )
   {

         $_this = new self;
      
         $result = DB::table($_this->store)->where('store_code', '=', $store_code)->first();

         $result = !empty($result->id) ? $result->id : 0 ; 

         return $result;      

   }

   public static function cnt_child_account( $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->where('parents_id', '=', $user_id)->count();

         return $result;      

   }

   public static function is_sub_admin( $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->select('parents_id')->where('id', '=', $user_id)->first();

         return $result;      

   }

   public static function insert_store( $data )
   {

         $_this = new self;
      
         $result = DB::table($_this->store)->insert($data);

         return $result;      

   }

   public static function get_user_photo( $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->select('photo')->where('id', '=', $user_id)->first();

         return $result; 
         
   }

   public static function edit_user_photo( $file_path, $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->where('id', $user_id)->update(array('photo' => $file_path));

         return $result; 
         
   }

   public static function get_user_image( $user_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->table)->select("photo")->find( $user_id );

         return $result; 
         
   }

   public static function get_rel_user_id( $user_id )
   {

         $_this = new self;
      
         $data = DB::table($_this->table)
                     ->select('id','parents_id')
                     ->where('id', '=', $user_id)
                     ->first();

         // 如果是子帳，用本帳id找出所有相關id，若不是，則用自身id找出所有相關id

         $find_id = $data->parents_id > 0 ? $data->parents_id : $data->id;

         $result = DB::table($_this->table)
                  ->select('id')
                  ->where('id', '=', $find_id)
                  ->orWhere('parents_id', '=', $find_id)
                  ->get();


         return $result;      

   }

   public static function get_expiring_user( $day = 27 )
   {

      $_this = new self;

      $result = DB::table($_this->table)
                  ->select('account','real_name')
                  ->whereRaw("DATEDIFF(NOW(),created_at)  = " . $day)
                  ->get();

      return $result; 

   }

   public static function get_user_by_store_id( $store_id )
   {

      $_this = new self;

      $result = DB::table($_this->table)
                  ->leftJoin($_this->store, $_this->store.'.user_id', '=', $_this->table.'.id')
                  ->select($_this->table.'.id','account','real_name')
                  ->where($_this->store.".id", "=", $store_id)
                  ->first();

      return $result; 

   }

   public static function add_invite_record( $data )
   {

         $_this = new self;
      
         $result = DB::table($_this->invite_record)->insert( $data );

         return $result; 
         
   }

   public static function check_invite_qualifications( $column, $store_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->invite_record)->where( $column, '=', $store_id)->get();

         return $result; 
         
   }

   public static function check_display_invite_btn( $store_id )
   {

         $_this = new self;
      
         $result = DB::table($_this->invite_record)->whereIn( "invite_store_id", $store_id)->get();

         return $result; 
         
   }

}