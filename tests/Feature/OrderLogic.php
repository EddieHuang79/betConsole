<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Order_logic;

class OrderLogic extends TestCase
{

    public function testGetOrderExtraColumn()
    {

		$test1 = Order_logic::get_order_extra_column();

		$this->assertTrue( is_array($test1) );

    }

	public function testInsertFormat()
	{

		$test1 = Order_logic::insert_format( 1 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInsertExtraFormat()
	{

		$test1 = Order_logic::insert_extra_format( array(), array(), 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Order_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateExtraFormat()
	{

		$test1 = Order_logic::update_extra_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddProduct()
	{

		$test1 = Order_logic::add_order( array() );

		$this->assertFalse( $test1 );

	}

	public function testAddExtraProduct()
	{

		$test1 = Order_logic::add_extra_order( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditProduct()
	{

		$test1 = Order_logic::edit_order( array(), "" );

		$this->assertFalse( $test1 );

	}

	public function testEditExtraProduct()
	{

		$test1 = Order_logic::edit_order_extra_data( array(), "" );

		$this->assertFalse( $test1 );

	}

	public function testGetOrderMumber()
	{

		$test1 = Order_logic::get_order_number();

		$this->assertTrue( is_int($test1) );

	}

	public function testGetOrderData()
	{

		$test1 = Order_logic::get_order_data();

		$this->assertTrue( true );

	}

	public function testGetOrderList()
	{

		$test1 = Order_logic::get_order_list( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_list( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_list( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetSingleOrderData()
	{

		$test1 = Order_logic::get_single_order_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_single_order_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_single_order_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testFIFOGetStockId()
	{

		$test1 = Order_logic::FIFO_get_stock_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::FIFO_get_stock_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::FIFO_get_stock_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testChangeFormat()
	{

		$test1 = Order_logic::change_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::change_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::change_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testFIFOStock()
	{

		$test1 = Order_logic::FIFO_stock( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::FIFO_stock( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::FIFO_stock( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetOrderDataForVerify()
	{

		$test1 = Order_logic::get_order_data_for_verify( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_data_for_verify( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_data_for_verify( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testChangeStatus()
	{

		$test1 = Order_logic::change_status( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::change_status( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::change_status( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testOrderStockRecordFormat()
	{

		$test1 = Order_logic::order_stock_record_format( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_stock_record_format( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_stock_record_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddOrderStockRecord()
	{

		$test1 = Order_logic::add_order_stock_record( "" );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::add_order_stock_record( 0 );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::add_order_stock_record( array() );

		$this->assertFalse( $test1 );

	}

	public function testOrderNumberEncode()
	{

		$test1 = Order_logic::order_number_encode( "" );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::order_number_encode( 0 );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::order_number_encode( array() );

		$this->assertFalse( $test1 );

	}

	public function testOrderNumberDecode()
	{

		$test1 = Order_logic::order_number_decode( "" );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::order_number_decode( 0 );

		$this->assertFalse( $test1 );

		$test1 = Order_logic::order_number_decode( array() );

		$this->assertFalse( $test1 );

	}

	public function testOrderVerify()
	{

		$test1 = Order_logic::order_verify( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_verify( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_verify( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testOrderUploadSampleOutput()
	{

		$test1 = Order_logic::order_upload_sample_output( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_upload_sample_output( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::order_upload_sample_output( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetOrderCnt()
	{

		$test1 = Order_logic::get_order_cnt( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_cnt( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_cnt( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetOrderSum()
	{

		$test1 = Order_logic::get_order_sum( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_sum( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_order_sum( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetHotSellTop5()
	{

		$test1 = Order_logic::get_hotSell_top5( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_hotSell_top5( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Order_logic::get_hotSell_top5( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testOrderListDataBind()
	{

		$test1 = Order_logic::order_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Order_logic::order_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Order_logic::order_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testOrderVerifyListDataBind()
	{

		$test1 = Order_logic::order_verify_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Order_logic::order_verify_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Order_logic::order_verify_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetOrderInputTemplateArray()
	{

		$test1 = Order_logic::get_order_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testOrderInputDataBind()
	{

		$test1 = Order_logic::order_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Order_logic::order_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Order_logic::order_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
