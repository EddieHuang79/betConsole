<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use App\logic\Redis_tool;
use App\logic\Admin_user_logic;

class Service
{

	protected $table = "service";

	protected $user_role = 'user_role_relation';

	protected $role_service = "role_service_relation";

	protected $service_user = "service_user_relation";

	protected $role = 'role';

	protected $user = 'user';

	public static function get_service_list( $option = array(), $pagesize = 15 )
	{

		$_this = new self();

		$data = DB::table($_this->table);
		$data = !empty($option["service_id"]) ? $data->whereIn("id", $option["service_id"]) : $data ;
		$data = !empty($option["service_name"]) ? $data->where("name", "like", "%".$option["service_name"]."%") : $data ;
		$data = !empty($option["status"]) ? $data->where("status", "=", $option["status"]) : $data ;		
		$data = $data->paginate($pagesize);

		return $data;

	}

	public static function get_service( $id = 0 )
	{

		$_this = new self();

		$data = DB::table($_this->table)->find($id);

		return $data;

	}

	public static function get_service_data()
	{

		$_this = new self();

		$data = DB::table($_this->table)->get();

		return $data;

	}

	public static function get_active_service()
	{

		$_this = new self();

		$data = DB::table($_this->table)->where("status", "=", "1")->get();

		return $data;

	}

	public static function add_service( $data )
	{

		$_this = new self;

		$service_id = DB::table($_this->table)->insertGetId($data);

		return $service_id;

	}

	public static function edit_service( $data, $where )
	{

		$_this = new self;

		$result = DB::table($_this->table)->where('id', $where)->update($data);

		return $result;

	}


	public static function get_parents_service()
	{

		$_this = new self();

		$data = DB::table($_this->table)->where("parents_id", "=", "0")->where("status", "=", "1")->get();

		return $data;

	}

    public static function menu_list( $redis_key )
    {	

    	$_this = new self;

    	$Login_user = Session::get('Login_user');

		$service = DB::table($_this->table)
					->leftJoin($_this->role_service, $_this->table.'.id', '=', $_this->role_service.'.service_id')
					->leftJoin($_this->user_role, $_this->user_role.'.role_id', '=', $_this->role_service.'.role_id')
					->select($_this->table.'.*')
					->where($_this->user_role.'.user_id', '=', $Login_user["user_id"])
					->where($_this->table.'.status', '=', 1)
					->orderBy($_this->table.'.sort')
					->get();

		return $service;

    }

	public static function get_service_id_by_role( $role_id )
	{

		$_this = new self();

		$data = DB::table($_this->role_service)->select("service_id")->where("role_id", "=", $role_id)->get();

		return $data;

	}

	public static function get_service_id_by_url_and_save( $url )
	{

		$_this = new self();

		$data = DB::table($_this->table)->select("id")->where("link", "=", $url)->get();

		return $data;

	}

	public static function get_unpublic_service_data()
	{

		$_this = new self();

		$data = DB::table($_this->table)->select("id", "name", "public")
					->where("status", "=", 1)
					->orderBy($_this->table.'.id', 'desc')
					->paginate(15);

		return $data;

	}

}

