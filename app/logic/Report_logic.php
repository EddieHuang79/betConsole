<?php

namespace App\logic;

use Illuminate\Support\Facades\Session;
use App\logic\Purchase_logic;
use App\logic\Order_logic;
use App\logic\Stock_logic;
use App\logic\Redis_tool;

class Report_logic extends Basetool
{


	// 本週訂單數

	public static function this_week_order_cnt()
	{

		$_this = new self();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,0,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = 0;

		$cnt = Redis_tool::get_week_order_cnt( $Redis_key );

		if ( is_null($cnt) || !is_numeric($cnt) ) 
		{

			$week_date = $_this->this_week_date();

			$cnt = Order_logic::get_order_cnt( $week_date, $shop_id, $status = array(1,2) );

			if ( !empty($cnt) ) 
			{

				$cnt = $cnt->cnt;
		
				Redis_tool::set_week_order_cnt( $Redis_key, $cnt );

				$result = number_format($cnt);

			}

		}

		return $result;

	}


	// 本週取消訂單數

	public static function week_cancel_order_cnt()
	{

		$_this = new self();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,10,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = 0;

		$cnt = Redis_tool::get_week_cancel_order_cnt( $Redis_key );

		if ( is_null($cnt) || !is_numeric($cnt) ) 
		{

			$week_date = $_this->this_week_date();

			$cnt = Order_logic::get_order_cnt( $week_date, $shop_id, $status = array(3) );

			if ( !empty($cnt) ) 
			{

				$cnt = $cnt->cnt;
		
				Redis_tool::set_week_cancel_order_cnt( $Redis_key, $cnt );

				$result = number_format($cnt);

			}

		}

		return $result;

	}


	// 本日入庫數

	public static function today_in_ws_cnt()
	{

		$_this = new self();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,20,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = 0;

		$cnt = Redis_tool::get_today_in_ws_cnt( $Redis_key );

		if ( is_null($cnt) || !is_numeric($cnt) ) 
		{

			$date = $_this->today_date();

			$cnt = Purchase_logic::get_purchase_sum( $date, $shop_id, $status = array(2) );

			if ( !empty($cnt->cnt) ) 
			{

				$cnt = $cnt->cnt;
		
				Redis_tool::set_today_in_ws_cnt( $Redis_key, $cnt );

				$result = number_format($cnt);

			}

		}

		return $result;

	}


	// 本日出庫數

	public static function today_out_ws_cnt()
	{

		$_this = new self();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,30,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = 0;

		$cnt = Redis_tool::get_today_out_ws_cnt( $Redis_key );

		if ( is_null($cnt) || !is_numeric($cnt) ) 
		{

			$date = $_this->today_date();

			$cnt = Order_logic::get_order_sum( $date, $shop_id, $status = array(1,2) );

			if ( !empty($cnt) ) 
			{

				$cnt = $cnt->cnt;
		
				Redis_tool::set_today_out_ws_cnt( $Redis_key, $cnt );

				$result = number_format($cnt);

			}

		}

		return $result;

	}


	// 每月訂單

	public static function month_order_view()
	{

		$_this = new self();

		$data = array();

		$cnt = array();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,40,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = array();

		$result = Redis_tool::get_month_order_view( $Redis_key );

		if ( is_null($result) || empty($result) ) 
		{

			$date = $_this->month_of_year_date();

			foreach ($date as $index => $row) 
			{

				$tmp = Order_logic::get_order_sum( $row, $shop_id, $status = array(1,2) );

				if ( !empty($tmp) ) 
				{

					$cnt[] = (int)$tmp->cnt;

					$data = Redis_tool::set_month_order_view( $Redis_key, $cnt );

					$result = $data;

				}
				
			}

		}

		return $result;

	}


	// 每日出入庫狀況

	public static function year_stock_view()
	{

		$_this = new self();

		$data = array();

		$cnt = array();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,50,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = array();

		$result = Redis_tool::get_year_stock_view( $Redis_key );

		if ( is_null($result) || empty($result) ) 
		{

			$date = $_this->month_of_year_date();

			if ( !empty($date) ) 
			{

				// 入庫

				foreach ($date as $index => $row) 
				{

					$tmp = Purchase_logic::get_purchase_sum( $row, $shop_id, $status = array(2) );
					
					$cnt["in"][] = $tmp->cnt * -1;

				}

				// 出庫

				foreach ($date as $index => $row) 
				{

					$tmp = Order_logic::get_order_sum( $row, $shop_id, $status = array(1,2) );
					
					$cnt["out"][] = $tmp->cnt;

				}

				$result = Redis_tool::set_year_stock_view( $Redis_key, $cnt );


			}

		}

		return $result;

	}


	// 庫存商品總類比例

	public static function stock_analytics()
	{

		$_this = new self();

		$data = array();

		$cnt = array();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,5,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = array();

		if ( !empty($shop_id) ) 
		{

			$result = Redis_tool::get_year_stock_view( $Redis_key );

			if ( is_null($result) || empty($result) ) 
			{

				// 取得資料

				$data = Stock_logic::get_stock_analytics( $shop_id );

				// 加入父類別翻譯

				$data = Stock_logic::get_stock_analytics_add_parents_category( $data );

				// 轉成第一層類別資料格式

				$parents_data = $_this->stock_analytics_level1_data( $data );

				$child_data = $_this->stock_analytics_level2_data( $data );

				$result	= array(
								"level1" => $parents_data,
								"level2" => $child_data,
							);

				$result = Redis_tool::set_year_stock_view( $Redis_key, $result );

			}

		}

		return $result;

	}


	// 月銷售top5

	public static function year_product_top5()
	{

		$_this = new self();

		$data = array();

		$cnt = array();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,5,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$result = array();

		$result = Redis_tool::get_year_product_top5( $Redis_key );

		if ( is_null($result) || empty($result) ) 
		{

			$date = $_this->month_of_year_date();

			// 出庫

			foreach ($date as $index => $row) 
			{

				// 總量

				$tmp = Order_logic::get_order_sum( $row, $shop_id, $status = array(1,2) );
				
				$cnt["total"][$index-1] = new \stdClass;

				$cnt["total"][$index-1]->name = date("M", mktime(0,0,0,$index,1,date("Y")));
				$cnt["total"][$index-1]->y = (int)$tmp->cnt;
				$cnt["total"][$index-1]->drilldown = date("M", mktime(0,0,0,$index,1,date("Y")));	

				$tmp = Order_logic::get_hotSell_top5( $row, $shop_id, $status = array(1,2) );

				$cnt["top5"][$index-1] = new \stdClass;
				$cnt["top5"][$index-1]->name = date("M", mktime(0,0,0,$index,1,date("Y")));
				$cnt["top5"][$index-1]->id = date("M", mktime(0,0,0,$index,1,date("Y")));

				$dataArray = array();

				foreach ($tmp as $row1) 
				{

					if ( is_object($row1) ) 
					{

						$dataArray[] =  array(
												$row1->product_name,
												(int)$row1->cnt,
											);

					}

				}

				$cnt["top5"][$index-1]->data = $dataArray;

			}

			$result = Redis_tool::set_year_product_top5( $Redis_key, $cnt );

		}

		return $result;

	}


	// 堆疊圖

	public static function product_top5_stack()
	{

		$_this = new self();

		$data = array();

		$cnt = array();

		$shop_id = Session::get( 'Store' );

		$search_deadline = mktime(date("H")+1,15,0,date("m"),date("d"),date("Y"));

		$Redis_key = $shop_id."_".$search_deadline;

		$data = Redis_tool::get_product_top5_stack( $Redis_key );

		// if ( is_null($data) || empty($data) ) 
		// {

			// 取得hot sell top 5

			$date = array(
						"start_date" 	=> "1970-01-01",
						"end_date" 		=> "1970-01-01"
					);

			$top5_product = Order_logic::get_hotSell_top5( $date, $shop_id, $status = array(1,2) );

			// 計算庫存總數與安庫數

			$data = Stock_logic::get_stock_and_safe_amount( $top5_product );

			$data = Redis_tool::set_product_top5_stack( $Redis_key, $data );

		// }

		return $data;

	}


	// 每月起始/結束日期

	protected function month_of_year_date()
	{

		$result = array();

		$year = date("Y");

		for ($month = 1; $month < 13; $month++) 
		{ 

			$result[$month] = array(
							"start_date" 	=> date("Y-m-01 00:00:00", mktime(0,0,0,$month,1,$year) ),
							"end_date" 		=> date("Y-m-t 23:59:59", mktime(0,0,0,$month+1,0,$year) )
						);

		}

		return $result;

	}


	// 每週起始/結束日期

	protected function this_week_date()
	{

		$today = strtotime("now");

		$week = date("w",$today);

		$first_day_cnt = (int)$week - 1;

		$first_day_cnt = $first_day_cnt < 0 ? $first_day_cnt + 7 : $first_day_cnt ;

		$last_day_cnt = $week > 0 ? 7 - (int)$week : 0;

		// $last_day_cnt = $first_day_cnt < 0 ? $first_day_cnt + 7 : $first_day_cnt ;

		// 禮拜一為第一天，禮拜日為最後一天

		$first_day = date("Y-m-d 00:00:00", mktime(0,0,0,date("m"),date("d",$today) - $first_day_cnt ,date("Y")));

		$last_day = date("Y-m-d 23:59:59", mktime(0,0,0,date("m"),date("d",$today) + $last_day_cnt ,date("Y"))); 

		$result = array(
					"start_date" 	=> $first_day,
					"end_date" 		=> $last_day,
				);

		return $result;

	}


	// 今日日期

	protected function today_date()
	{

		$result = array(
					"start_date" 	=> date("Y-m-d 00:00:00", time()),
					"end_date" 		=> date("Y-m-d 23:59:59", time()),
				);

		return $result;

	}


	// 庫存商品種類比例資料 第一層

	protected function stock_analytics_level1_data( $data )
	{

		$result = array();

		$total = 0;

		$parents_category = array();

		$category_total = array();

		$year = date("Y");

		foreach ($data as $row) 
		{

			$parents_category[$row->parents_category] = $row->parents_category_name;

			$category_total[$row->parents_category] = isset($category_total[$row->parents_category] ) ? $category_total[$row->parents_category]  : 0 ;
			
			$category_total[$row->parents_category]+= $row->stock;

			$total += $row->stock;

		}

		foreach ($data as $row) 
		{

			$result[$parents_category[$row->parents_category]] = round( $category_total[$row->parents_category] / $total * 100 ,2);

		}

		return $result;

	}


	// 庫存商品種類比例資料 第二層

	protected function stock_analytics_level2_data( $data )
	{

		$result = array();

		$total = 0;

		$category = array();

		$category_total = array();

		$year = date("Y");

		foreach ($data as $row) 
		{

			$category[$row->category] = $row->name;

			$category_total[$row->category] = isset($category_total[$row->category] ) ? $category_total[$row->category]  : 0 ;
			$category_total[$row->category]+= $row->stock;

			$total += $row->stock;

		}

		foreach ($data as $row) 
		{

			$result[$row->parents_category][$category[$row->category]] = round( $category_total[$row->category] / $total * 100 ,2);

		}

		return $result;

	}

}
