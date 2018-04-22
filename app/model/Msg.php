<?php

namespace App\model;

use Illuminate\Support\Facades\DB;

class Msg
{

	protected $table = "msg";

	protected $page_size = 15;


	public static function get_msg( $role_id, $show_type, $msg_type, $user_id )
	{

		$_this = new self;

		$now = date("Y-m-d H:i:s");

		
		if ( !in_array(0, $role_id) ) 
		{
			$role_id[] = 0;
		}

		if ( !in_array(0, $user_id) ) 
		{
			$user_id[] = 0;
		}

		$result = DB::table($_this->table)
				->select("id", "subject", "content", "updated_at")
				->whereIn("role_id", $role_id)
				->whereIn("show_type", $show_type)
				->where("start_date", "<=", $now)
				->where("end_date", ">=", $now)
				->where("public", "=", 1)
				->whereIn("user_id", $user_id)
				->whereIn("msg_type", $msg_type)
				->orderBy('id', 'asc')
				->get();


		return $result;

	}	


	public static function get_all_msg( $data )
	{

		$_this = new self;

		$result = DB::table($_this->table);

		$result = !empty($data["type"]) ? $result->where("msg_type", "=", $data["type"]) : $result ;

		$result = $result->orderBy('id', 'asc')->paginate($_this->page_size);

		return $result;

	}	


	public static function get_single_msg( $msg_id )
	{

		$_this = new self;

		$result = DB::table($_this->table)->find($msg_id);

		return $result;

	}	

	public static function edit_msg( $data, $where )
	{

		$_this = new self;

		$result = DB::table($_this->table)->where('id', $where)->update($data);

		return $result;

	}

	public static function add_msg( $data )
	{

		$_this = new self;

		$result = DB::table($_this->table)->insert($data);

		return $result;

	}

}
