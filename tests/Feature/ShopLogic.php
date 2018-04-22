<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Shop_logic;

class ShopLogic extends TestCase
{

    public function testServiceBuy()
    {

		$test1 = Shop_logic::service_buy( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::service_buy( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::service_buy( array() );

		$this->assertFalse( $test1 );

    }

	public function testGetMallProduct()
	{

		$test1 = Shop_logic::get_mall_product( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_mall_product( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_mall_product( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testOrderFormat()
	{

		$test1 = Shop_logic::order_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::order_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::order_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUseDataFormat()
	{

		$test1 = Shop_logic::use_data_format( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::use_data_format( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::use_data_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testShopBuyInsert()
	{

		$test1 = Shop_logic::shop_buy_insert( "" );

		$this->assertEquals($test1, "/buy_record");

		$test1 = Shop_logic::shop_buy_insert( 0 );

		$this->assertEquals($test1, "/buy_record");

		$test1 = Shop_logic::shop_buy_insert( array() );

		$this->assertEquals($test1, "/buy_record");

	}

	public function testCheckLegal()
	{

		$test1 = Shop_logic::check_legal( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::check_legal( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::check_legal( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddUseRecord()
	{

		$test1 = Shop_logic::add_use_record( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::add_use_record( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::add_use_record( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetMallProductUseRecord()
	{

		$test1 = Shop_logic::get_mall_product_use_record( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_mall_product_use_record( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_mall_product_use_record( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testCountDeadline()
	{

		$test1 = Shop_logic::count_deadline( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::count_deadline( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::count_deadline( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetDataByActionKey()
	{

		$test1 = Shop_logic::get_data_by_action_key( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_data_by_action_key( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_data_by_action_key( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetDateSpecUniqueArray()
	{

		$test1 = Shop_logic::get_date_spec_unique_array( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_date_spec_unique_array( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_date_spec_unique_array( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetCountByActionKey()
	{

		$test1 = Shop_logic::get_count_by_action_key( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_count_by_action_key( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_count_by_action_key( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetDeadline()
	{

		$test1 = Shop_logic::get_deadline( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::get_deadline( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::get_deadline( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetMallOrderNumber()
	{

		$test1 = Shop_logic::get_mall_order_number( "" );

		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 1);

		$test1 = Shop_logic::get_mall_order_number( 0 );

		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 1);

		$test1 = Shop_logic::get_mall_order_number( array() );

		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 1);

	}

	public function testGetRecordCnt()
	{

		$test1 = Shop_logic::get_record_cnt( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_record_cnt( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_record_cnt( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testOrderNumberEncode()
	{

		$test1 = Shop_logic::order_number_encode( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::order_number_encode( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::order_number_encode( array() );

		$this->assertFalse( $test1 );

	}

	public function testOrderNumberDecode()
	{

		$test1 = Shop_logic::order_number_decode( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::order_number_decode( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::order_number_decode( array() );

		$this->assertFalse( $test1 );

	}

	public function testPaymentDataFormat()
	{

		$test1 = Shop_logic::PaymentData_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::PaymentData_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::PaymentData_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddPaymentData()
	{

		$test1 = Shop_logic::add_payment_data( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::add_payment_data( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::add_payment_data( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetPaymentData()
	{

		$test1 = Shop_logic::get_payment_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_payment_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Shop_logic::get_payment_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testActiveMallServiceProcess()
	{

		$test1 = Shop_logic::active_mall_service_process( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( array() );

		$this->assertFalse( $test1 );

	}

	public function testActiveMallService()
	{

		$test1 = Shop_logic::active_mall_service_process( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( array() );

		$this->assertFalse( $test1 );

	}

	public function testDataReceive()
	{

		$test1 = Shop_logic::active_mall_service_process( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::active_mall_service_process( array() );

		$this->assertFalse( $test1 );

	}

	public function testIsFirstBuy()
	{

		$test1 = Shop_logic::is_first_buy( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::is_first_buy( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::is_first_buy( array() );

		$this->assertFalse( $test1 );

	}

	public function testSendFirstBuyMail()
	{

		$test1 = Shop_logic::send_first_buy_mail( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::send_first_buy_mail( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::send_first_buy_mail( array() );

		$this->assertFalse( $test1 );

	}

	public function testFirstBuyGiftLogic()
	{

		$test1 = Shop_logic::first_buy_gift_logic( "" );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::first_buy_gift_logic( 0 );

		$this->assertFalse( $test1 );

		$test1 = Shop_logic::first_buy_gift_logic( array() );

		$this->assertFalse( $test1 );

	}

}
