<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Redis_tool;

class RedisLogic extends TestCase
{

	public function testSetSearchTool()
	{

		$test1 = Redis_tool::set_search_tool( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_search_tool( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_search_tool( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetSearchTool()
	{

		$test1 = Redis_tool::get_search_tool();

		$this->assertEquals($test1, array());

	}

	public function testSetUserRole()
	{

		$test1 = Redis_tool::set_user_role( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_user_role( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_user_role( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetUserRole()
	{

		$test1 = Redis_tool::get_user_role( "" );

		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_user_role( 0 );

		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_user_role( array() );

		$this->assertEquals($test1, array());

	}

	public function testDelUserRole()
	{

		$test1 = Redis_tool::del_user_role( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::del_user_role( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::del_user_role( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetMenuData()
	{

		$test1 = Redis_tool::set_menu_data( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_menu_data( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_menu_data( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetMenuData()
	{

		$test1 = Redis_tool::get_menu_data( "" );

		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_menu_data( 0 );

		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_menu_data( array() );

		$this->assertEquals($test1, array());

	}

	public function testDelMenuData()
	{

		$test1 = Redis_tool::del_menu_data_all();

		$this->assertTrue( true );

	}

	public function testSetActiveRole()
	{

		$test1 = Redis_tool::set_active_role( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_active_role( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_active_role( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetActiveRole()
	{

		$test1 = Redis_tool::get_active_role();

		$this->assertTrue( is_array($test1) );

	}

	public function testSetReadMsg()
	{

		$test1 = Redis_tool::set_read_msg( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_read_msg( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_read_msg( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetReadMsg()
	{

		$test1 = Redis_tool::get_read_msg( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_read_msg( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Redis_tool::get_read_msg( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testSetWeekOrderCnt()
	{

		$test1 = Redis_tool::set_week_order_cnt( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_week_order_cnt( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_week_order_cnt( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetWeekOrderCnt()
	{

		$test1 = Redis_tool::get_week_order_cnt( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_week_order_cnt( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_week_order_cnt( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetWeekCancelOrderCnt()
	{

		$test1 = Redis_tool::set_week_cancel_order_cnt( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_week_cancel_order_cnt( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_week_cancel_order_cnt( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetWeekCancelOrderCnt()
	{

		$test1 = Redis_tool::get_week_cancel_order_cnt( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_week_cancel_order_cnt( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_week_cancel_order_cnt( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetTodayInWsCnt()
	{

		$test1 = Redis_tool::set_today_in_ws_cnt( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_today_in_ws_cnt( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_today_in_ws_cnt( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetTodayInWsCnt()
	{

		$test1 = Redis_tool::get_today_in_ws_cnt( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_today_in_ws_cnt( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_today_in_ws_cnt( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetTodayOutWsCnt()
	{

		$test1 = Redis_tool::set_today_out_ws_cnt( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_today_out_ws_cnt( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_today_out_ws_cnt( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetTodayOutWsCnt()
	{

		$test1 = Redis_tool::get_today_out_ws_cnt( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_today_out_ws_cnt( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_today_out_ws_cnt( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetMonthOrderView()
	{

		$test1 = Redis_tool::set_month_order_view( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_month_order_view( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_month_order_view( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetMonthOrderView()
	{

		$test1 = Redis_tool::get_month_order_view( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_month_order_view( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_month_order_view( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetYearStockView()
	{

		$test1 = Redis_tool::set_year_stock_view( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_year_stock_view( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_year_stock_view( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetYearStockView()
	{

		$test1 = Redis_tool::get_year_stock_view( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_year_stock_view( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_year_stock_view( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetStockAnalytics()
	{

		$test1 = Redis_tool::set_stock_analytics( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_stock_analytics( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_stock_analytics( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetStockAnalytics()
	{

		$test1 = Redis_tool::get_stock_analytics( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_stock_analytics( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_stock_analytics( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetYearProductTop5()
	{

		$test1 = Redis_tool::set_year_product_top5( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_year_product_top5( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_year_product_top5( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetYearProductTop5()
	{

		$test1 = Redis_tool::get_year_product_top5( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_year_product_top5( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_year_product_top5( array() );

		$this->assertFalse( $test1 );

	}

	public function testSetProductTop5Stack()
	{

		$test1 = Redis_tool::set_product_top5_stack( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_product_top5_stack( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::set_product_top5_stack( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetProductTop5Stack5()
	{

		$test1 = Redis_tool::get_product_top5_stack( "" );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_product_top5_stack( 0 );

		$this->assertFalse( $test1 );

		$test1 = Redis_tool::get_product_top5_stack( array() );

		$this->assertFalse( $test1 );

	}


}
