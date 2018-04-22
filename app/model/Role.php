<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role
{

	protected $table = "role";

	protected $user_role = 'user_role_relation';

	protected $role_service = "role_service_relation";

	public static function get_role_list($option = array(), $page_size = 15)
	{

		$_this = new self;

		$data = DB::table($_this->table);
		$data = !empty($option["role_name"]) ? $data->where("name", "like", "%".$option["role_name"]."%") : $data ;
		$data = !empty($option["status"]) ? $data->where("status", "=", $option["status"]) : $data ;
		$data = $data->paginate($page_size);

		return $data;

	}

	public static function get_role( $id = 0 )
	{

		$_this = new self();

		$data = DB::table($_this->table)->find($id);

		return $data;

	}

	public static function get_role_data()
	{

		$_this = new self();

		$data = DB::table($_this->table)->get();

		return $data;

	}

	public static function add_role( $data )
	{

		$_this = new self;

		$role_id = DB::table($_this->table)->insertGetId($data);

		return $role_id;

	}

	public static function edit_role( $data, $where )
	{

		$_this = new self;

		$result = DB::table($_this->table)->where('id', $where)->update($data);

		return $result;

	}

	public static function get_active_role()
	{

		$_this = new self();

		$data = DB::table($_this->table)->where("status", "=", "1")->get();

		return $data;

	}

   public static function get_role_service( $role_id = 0, $service_id = 0)
   {

		$_this = new self;

		// for role edit use, we should show all role
		if ($role_id > 0 && $service_id <= 0 ) 
		{
					
			$result = DB::table($_this->role_service)
					->leftJoin($_this->table, $_this->role_service.'.role_id', '=', $_this->table.'.id')
					->select($_this->role_service.'.*', $_this->table.'.name as role_name')
					->where('role_id', "=", $role_id)
					->get();

		}

		// for service edit use, we should show active role
		elseif ($role_id <= 0 && $service_id > 0)
		{

			$result = DB::table($_this->role_service)
					->leftJoin($_this->table, $_this->role_service.'.role_id', '=', $_this->table.'.id')
					->select($_this->role_service.'.*', $_this->table.'.name as role_name')
					->where('service_id', "=", $service_id)
					->where($_this->table.'.status', "=", 1)
					->get();

		}

		// for service index use, we should show active role
		else
		{
			$result = DB::table($_this->role_service)
					->leftJoin($_this->table, $_this->role_service.'.role_id', '=', $_this->table.'.id')
					->select($_this->role_service.'.*', $_this->table.'.name as role_name')
					->where($_this->table.'.status', "=", 1)
					->get();

		}	

        return $result;

	}

	public static function add_role_service( $data )
	{

		$_this = new self;

		$result = DB::table($_this->role_service)->insert($data);

		return $result;

	}


	public static function delete_role_service( $role_id = 0, $service_id = 0 )
	{

		$_this = new self;

		if ($role_id > 0) 
		{
			$result = DB::table($_this->role_service)->where('role_id', '=', $role_id)->delete();
		}

		if ($service_id > 0) 
		{
			$result = DB::table($_this->role_service)->where('service_id', '=', $service_id)->delete();
		}

		return $result;

	}

}
