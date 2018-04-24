<?php

namespace App\model;

use Illuminate\Support\Facades\DB;

class API_data
{

	protected $user_table = 'frontend_user';

	protected $log_table = 'frontend_user_log';

	public static function report1($column)
	{

		$_this = new self();

		$data = DB::table($_this->log_table)
				->leftJoin($_this->user_table, $_this->log_table.'.frontend_user_id', '=', $_this->user_table.'.id')
				->select(
						"PromotionType",
						\DB::raw('count('.$_this->log_table.'.id) as cnt')
					)
				->where($column, ">", "0")
				->groupBy("PromotionType")
				->get();

		return $data;

	}

	public static function report2()
	{

		$_this = new self();

		$data = DB::table($_this->log_table)
				->leftJoin($_this->user_table, $_this->log_table.'.frontend_user_id', '=', $_this->user_table.'.id')
				->select(
						"PromotionType",
						\DB::raw('SUM(DepositAmount) as SumDepositAmount'),
						\DB::raw('SUM(WithdrawalAmount) as SumWithdrawalAmount'),
						\DB::raw('SUM(FundOut) as SumFundOut'),
						\DB::raw('SUM(FundIn) as SumFundIn')
					)
				->groupBy("PromotionType")
				->get();

		return $data;

	}

	public static function report3( $date )
	{

		$_this = new self();

		$data = DB::table($_this->log_table)
				->leftJoin($_this->user_table, $_this->log_table.'.frontend_user_id', '=', $_this->user_table.'.id')
				->select(
						"PromotionType",
						\DB::raw('SUM(DepositAmount) as SumDepositAmount')
					)
				->whereBetween($_this->log_table.'.created_at', [$date . " 00:00:00", $date . " 23:59:59"])
				->groupBy("PromotionType")
				->get();

		return $data;

	}

	public static function report4( $date )
	{

		$_this = new self();

		$data = DB::table($_this->log_table)
				->leftJoin($_this->user_table, $_this->log_table.'.frontend_user_id', '=', $_this->user_table.'.id')
				->select(
						"PromotionType",
						\DB::raw('SUM(WithdrawalAmount) as SumWithdrawalAmount')
					)
				->whereBetween($_this->log_table.'.created_at', [$date . " 00:00:00", $date . " 23:59:59"])
				->groupBy("PromotionType")
				->get();

		return $data;

	}

	public static function report5( $date )
	{

		$_this = new self();

		$data = DB::table($_this->log_table)
				->leftJoin($_this->user_table, $_this->log_table.'.frontend_user_id', '=', $_this->user_table.'.id')
				->select(
						"PromotionType",
						$_this->log_table.'.frontend_user_id'
					)
				->whereBetween($_this->log_table.'.created_at', [$date . " 00:00:00", $date . " 23:59:59"])
				->get();

		return $data;

	}

}
