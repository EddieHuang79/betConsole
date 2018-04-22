<?php

namespace App\logic;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class Redis_tool
{

	protected $Search_tool_key = "search_tool_";

	protected $User_role_key = "User_role_";

	protected $Menu_key = "menu_data_";

	protected $Active_role_key = "Active_role";

	protected $msg_key = "msg_";

	protected $week_order_cnt_key = "week_order_cnt_";

	protected $week_cancel_order_cnt_key = "week_cancel_order_cnt_";

	protected $today_in_ws_cnt_key = "today_in_ws_cnt_";

	protected $today_out_ws_cnt_key = "today_out_ws_cnt_";

	protected $month_order_view_key = "month_order_view_";

	protected $year_stock_view_key = "year_stock_view_";

	protected $year_product_top5_key = "year_product_top5_";

	protected $stock_analytics_key = "stock_analytics_";

	protected $product_top5_stack_key = "product_top5_stack_";
    
    
	// 設定搜尋工具

	public static function set_search_tool( $data, $service_id )
	{

		$_this = new self();

		$result = false;

		if ( !empty($data) && is_array($data) && !empty($service_id) && is_int($service_id) ) 
		{

			$Search_tool_key = $_this->Search_tool_key.$service_id;

			Redis::set( $Search_tool_key, json_encode($data) );

			$result = true;

		}

		return $result;

	}


	// 取得搜尋工具

	public static function get_search_tool()
	{

		$_this = new self;

		$service_id = Session::get('service_id');

		if ( !empty($service_id) && (int)$service_id > 0 ) 
		{

			$Search_tool_key = $_this->Search_tool_key.$service_id;

			$data = Redis::get( $Search_tool_key );
		
		}

		$result = !empty($data) ? json_decode($data, true) : array() ;

		return $result;

	}


	// 設定帳號角色關聯

	public static function set_user_role( $data, $user_id )
	{

		$_this = new self();

		$result = false;

		if ( !empty($data) && is_array($data) && !empty($user_id) && is_int($user_id) ) 
		{

			$User_role_key = $_this->User_role_key.$user_id;

			empty(Redis::get( $User_role_key )) ? Redis::set( $User_role_key, json_encode($data) ) : "" ;

			$result = true;

		}

		return $result;

	}


	// 取得帳號角色關聯

	public static function get_user_role( $id )
	{

		$_this = new self();

		if ( !empty($id) && is_int($id) ) 
		{

			$User_role_key = $_this->User_role_key.$id;

			$data = Redis::get($User_role_key);

		}

		$result = !empty($data) ? json_decode($data) : array() ;

		return $result;

	}


	// 刪除帳號角色關連

	public static function del_user_role( $user_id )
	{

		$_this = new self();

		$result = false;

		if ( !empty($user_id) && is_int($user_id) ) 
		{

			$User_role_key = $_this->User_role_key.$user_id;
			
			Redis::del( $User_role_key );

			$result = true;

		}

		return $result;

	}


	// 設定後台選單

	public static function set_menu_data( $key, $data )
	{

		$_this = new self();

		$result = false;

		if ( !empty($data) && is_array($data) && !empty($key) ) 
		{

			$Menu_data_key = $_this->Menu_key.$key;

			empty(Redis::get( $Menu_data_key )) ? Redis::set( $Menu_data_key, json_encode($data) ) : "" ;

			$result = true;

		}

		return $result;

	}


	// 取得後台選單

	public static function get_menu_data( $key )
	{

		$_this = new self();

		$result = array();

		if ( !empty($key) ) 
		{

			$Menu_data_key = $_this->Menu_key.$key;

			$result = Redis::get( $Menu_data_key );

		}

		return $result;

	}


	// 刪除後台選單

	public static function del_menu_data_all()
	{

		$_this = new self();

		$result = false;

		$Menu_data_key = $_this->Menu_key."*";

		$match_key = Redis::KEYS( $Menu_data_key );

		if ( !empty($match_key) ) 
		{		

			foreach ($match_key as $del_key) 
			{

				Redis::del( $del_key );
			
			}
		
			$result = true;

		}

		return $result;

	}


	// 設定有效角色

	public static function set_active_role( $data )
	{

		$_this = new self();

		$result = false;

		if ( !empty($data) ) 
		{

			$Active_role_key = $_this->Active_role_key;

			Redis::set( $Active_role_key, json_encode($data) );

			$result = true;

		}

		return $result;

	}


	// 取得有效角色

	public static function get_active_role()
	{

		$_this = new self();

		$result = array();

		$Active_role_key = $_this->Active_role_key;

		$data = Redis::get( $Active_role_key );

		if ( !empty($data) ) 
		{

			$result = json_decode($data);

		}
		
		return $result;

	}


	// 設定已讀訊息

	public static function set_read_msg( $user_id, $msg_id )
	{

		$_this = new self();

		$result = false;

		if ( !empty($user_id) && is_int($user_id) && !empty($msg_id) && is_int($msg_id) ) 
		{

			$msg_key = $_this->msg_key . $user_id;

			$data = Redis::get( $msg_key );

			$data = isset($data) ? json_decode($data, true) : array() ;

			if (!in_array($msg_id, $data)) 
			{
				$data[] = $msg_id;
			}

			Redis::set( $msg_key, json_encode($data) );

			$result = true;

		}

		return $result;

	}


	// 取得已讀訊息

	public static function get_read_msg( $user_id )
	{

		$_this = new self();

		$result = array();

		if ( !empty($user_id) && is_int($user_id) ) 
		{

			$msg_key = $_this->msg_key . $user_id;

			$data = Redis::get( $msg_key );

			$result = isset($data) ? json_decode($data, true) : array() ;

		}

		return $result;

	}


	// 儲存周訂單數

	public static function set_week_order_cnt( $key, $cnt )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) && is_int($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->week_order_cnt_key );

			$week_order_cnt_key = $_this->week_order_cnt_key.$key;

			Redis::set( $week_order_cnt_key, $cnt ) ;

		}

		return $result;

	}


	// 取得周訂單數

	public static function get_week_order_cnt( $key )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) ) 
		{

			$week_order_cnt_key = $_this->week_order_cnt_key.$key;

			$data = Redis::get( $week_order_cnt_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 儲存週取消訂單數

	public static function set_week_cancel_order_cnt( $key, $cnt )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) && is_int($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->week_cancel_order_cnt_key );

			$week_cancel_order_cnt_key = $_this->week_cancel_order_cnt_key.$key;

			Redis::set( $week_cancel_order_cnt_key, $cnt ) ;

		}

		return $result;

	}


	// 取得週取消訂單數

	public static function get_week_cancel_order_cnt( $key )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) ) 
		{

			$week_cancel_order_cnt_key = $_this->week_cancel_order_cnt_key.$key;

			$data = Redis::get( $week_cancel_order_cnt_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 儲存本日入庫數

	public static function set_today_in_ws_cnt( $key, $cnt )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) && is_int($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->today_in_ws_cnt_key );

			$today_in_ws_cnt_key = $_this->today_in_ws_cnt_key.$key;

			Redis::set( $today_in_ws_cnt_key, $cnt ) ;

		}

		return $result;

	}


	// 取得本日入庫數

	public static function get_today_in_ws_cnt( $key )
	{

		$_this = new self();

		$result = false;

		if ( !empty($key) ) 
		{

			$today_in_ws_cnt_key = $_this->today_in_ws_cnt_key.$key;

			$data = Redis::get( $today_in_ws_cnt_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 設定本日出庫數

	public static function set_today_out_ws_cnt( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_int($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->today_out_ws_cnt_key );

			$today_out_ws_cnt_key = $_this->today_out_ws_cnt_key.$key;

			Redis::set( $today_out_ws_cnt_key, $cnt ) ;

		}

		return $result;

	}


	// 取得本日出庫數

	public static function get_today_out_ws_cnt( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$today_out_ws_cnt_key = $_this->today_out_ws_cnt_key.$key;

			$data = Redis::get( $today_out_ws_cnt_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;


	}


	// 設定月訂單資料

	public static function set_month_order_view( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_array($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->month_order_view_key );

			$month_order_view_key = $_this->month_order_view_key.$key;

			$cnt = json_encode($cnt);

			Redis::set( $month_order_view_key, $cnt ) ;

			$result = $cnt;

		}

		return $result;

	}


	// 取得月訂單資料

	public static function get_month_order_view( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$month_order_view_key = $_this->month_order_view_key.$key;

			$data = Redis::get( $month_order_view_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 設定年庫存

	public static function set_year_stock_view( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_array($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->year_stock_view_key );

			$year_stock_view_key = $_this->year_stock_view_key.$key;

			$cnt = json_encode($cnt);

			Redis::set( $year_stock_view_key, $cnt ) ;

			$result = $cnt;

		}

		return $result;

	}


	// 取得年庫存

	public static function get_year_stock_view( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$year_stock_view_key = $_this->year_stock_view_key.$key;

			$data = Redis::get( $year_stock_view_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 設定庫存分析

	public static function set_stock_analytics( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_array($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->stock_analytics_key );

			$stock_analytics_key = $_this->stock_analytics_key.$key;

			$cnt = json_encode($cnt);

			Redis::set( $stock_analytics_key, $cnt ) ;

			$result = $cnt;

		}

		return $result;
	}


	// 取得庫存分析

	public static function get_stock_analytics( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$stock_analytics_key = $_this->stock_analytics_key.$key;

			$data = Redis::get( $stock_analytics_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 設定年度top5

	public static function set_year_product_top5( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_array($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->year_product_top5_key );

			$year_product_top5_key = $_this->year_product_top5_key.$key;

			$cnt = json_encode($cnt);

			Redis::set( $year_product_top5_key, $cnt ) ;

			$result = $cnt;

		}

		return $result;

	}


	// 取得年度top5

	public static function get_year_product_top5( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$year_product_top5_key = $_this->year_product_top5_key.$key;

			$data = Redis::get( $year_product_top5_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 設定年度top5 - 堆疊圖

	public static function set_product_top5_stack( $key, $cnt )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) && is_array($cnt) ) 
		{

			$_this->del_key_by_keyword( $_this->product_top5_stack_key );

			$product_top5_stack_key = $_this->product_top5_stack_key.$key;

			$cnt = json_encode($cnt);

			Redis::set( $product_top5_stack_key, $cnt ) ;

			$result = $cnt;

		}

		return $result;

	}


	// 取得年度top5 - 堆疊圖

	public static function get_product_top5_stack( $key )
	{

		$_this = new self;

		$result = false;

		if ( !empty($key) ) 
		{

			$product_top5_stack_key = $_this->product_top5_stack_key.$key;

			$data = Redis::get( $product_top5_stack_key );

			$result = !empty($data) ? $data : "" ;

		}

		return $result;

	}


	// 以關鍵字刪除資料

	protected function del_key_by_keyword( $keyword )
	{

		$result = false;

		if ( !empty($keyword) ) 
		{

			$data = Redis::keys( $keyword . "*" );

			foreach ($data as $row) 
			{

				Redis::del( $row );
			
			}

			$result = true;

		}

		return $result;

	}

}
