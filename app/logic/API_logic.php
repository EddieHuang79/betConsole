<?php

namespace App\logic;

use App\model\API_data;

class API_logic
{

	public static function report1( $column )
	{

		$_this = new self();

		$result = array();

		if ( !empty($column) && is_string($column) ) 
		{

			$data = API_data::report1( $column );

			$result = $data->toArray();

		}

		return $result;

	}

	public static function report2()
	{

		$_this = new self();

		$data = API_data::report2();

		$result = $data->toArray();

		return $result;

	}

	public static function report3( $date )
	{

		$_this = new self();

		$data = API_data::report3( $date );

		$result = $data->toArray();

		return $result;

	}

	public static function report4( $date )
	{

		$_this = new self();

		$data = API_data::report4( $date );

		$result = $data->toArray();

		return $result;

	}

	public static function report5( $date )
	{

		$_this = new self();

		$result = array(
						1 => array(),
						2 => array(),
						3 => array(),
						// 4 => array()
					);

		$data = API_data::report5( $date );

		foreach ($data as $row) 
		{
			
			if ( !in_array($row->frontend_user_id, $result[$row->PromotionType]) ) 
			{

				$result[$row->PromotionType][] = (int)$row->frontend_user_id;

			}

		}

		return $result;

	}

}