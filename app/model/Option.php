<?php

namespace App\model;

use Illuminate\Support\Facades\DB;

class Option
{

	protected $table = "option";

	public static function get_store_data()
	{

		$_this = new self();

		$data = DB::table($_this->table)->where("type", "=", "1")->where("status", "=", "1")->get();

		return $data;

	}	

	public static function get_store_type_by_id( $store_id )
	{

		$_this = new self();

		$data = DB::table($_this->table)->select("id", "key", "value")->whereIn("id", $store_id)->get();

		return $data;

	}

	public static function get_option( $data )
	{

		$_this = new self;

		$result = DB::table($_this->table)->select("key", "value")->whereIn("key", $data)->get();

		return $result;

	}

}
