<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Ecoupon_logic;

class EcouponLogic extends TestCase
{

	public function testTestData()
	{

		$test1 = Ecoupon_logic::test_data( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::test_data( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::test_data( array() );

		$this->assertTrue( is_array($test1) );

	}


	public function testInsertFormat()
	{

		$test1 = Ecoupon_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testUpdateFormat()
	{

		$test1 = Ecoupon_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testAddEcoupon()
	{

		$test1 = Ecoupon_logic::add_ecoupon( "" );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::add_ecoupon( 0 );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::add_ecoupon( array() );

		$this->assertFalse( $test1 );

	}


	public function testEditEcoupon()
	{

		$test1 = Ecoupon_logic::edit_ecoupon( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::edit_ecoupon( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::edit_ecoupon( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetEcouponType()
	{

		$test1 = Ecoupon_logic::get_ecoupon_type();

		$this->assertTrue( is_array($test1) );

	}


	public function testGetEcouponMatchType()
	{

		$test1 = Ecoupon_logic::get_ecoupon_match_type();

		$this->assertTrue( is_array($test1) );

	}


	public function testGetSingleEcoupon()
	{

		$test1 = Ecoupon_logic::get_single_ecoupon( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_single_ecoupon( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_single_ecoupon( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testGetEcouponInputTemplateArray()
	{

		$test1 = Ecoupon_logic::get_ecoupon_input_template_array();

		$this->assertTrue( is_array($test1) );

	}


	public function testGetEcouponStoreTypeArray()
	{

		$test1 = Ecoupon_logic::get_ecoupon_store_type_array( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_ecoupon_store_type_array( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_ecoupon_store_type_array( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testEcouponInputDataBind()
	{

		$test1 = Ecoupon_logic::ecoupon_input_data_bind( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Ecoupon_logic::ecoupon_input_data_bind( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Ecoupon_logic::ecoupon_input_data_bind( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, array());

	}


	public function testEcouponListDataBind()
	{

		$test1 = Ecoupon_logic::ecoupon_list_data_bind( "", "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::ecoupon_list_data_bind( 0, 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::ecoupon_list_data_bind( array(), array() );

		$this->assertTrue( is_array($test1) );

	}


	public function testSendEcoupon()
	{

		$test1 = Ecoupon_logic::send_ecoupon( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::send_ecoupon( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::send_ecoupon( array(), array() );

		$this->assertFalse( $test1 );

	}


	public function testGetUserActiveEcoupon()
	{

		$test1 = Ecoupon_logic::get_user_active_ecoupon( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_user_active_ecoupon( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_user_active_ecoupon( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testGetExpiringEcoupon()
	{

		$test1 = Ecoupon_logic::get_expiring_ecoupon();

		$this->assertTrue( is_array($test1) );

	}


	public function testInsertRecordFormat()
	{

		$test1 = Ecoupon_logic::insert_record_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::insert_record_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::insert_record_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testAddEcouponUseRecord()
	{

		$test1 = Ecoupon_logic::add_ecoupon_use_record( "" );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::add_ecoupon_use_record( 0 );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::add_ecoupon_use_record( array() );

		$this->assertFalse( $test1 );

	}


	public function testInactiveEcouponUseStatus()
	{

		$test1 = Ecoupon_logic::inactive_ecoupon_use_status( "" );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::inactive_ecoupon_use_status( 0 );

		$this->assertFalse( $test1 );

		$test1 = Ecoupon_logic::inactive_ecoupon_use_status( array() );

		$this->assertFalse( $test1 );

	}


	public function testGetEcouponFullData()
	{

		$test1 = Ecoupon_logic::get_ecoupon_full_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_ecoupon_full_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_ecoupon_full_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testGetEcouponDiscountPrice()
	{

		$test1 = Ecoupon_logic::get_ecoupon_discount_price( "", "", "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::get_ecoupon_discount_price( 0, 0, 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::get_ecoupon_discount_price( array(), array(), array() );

		$this->assertTrue( is_array($test1) );

	}


	public function testGetEcouponUseRecord()
	{

		$test1 = Ecoupon_logic::get_ecoupon_use_record( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::get_ecoupon_use_record( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Ecoupon_logic::get_ecoupon_use_record( array() );

		$this->assertTrue( is_array($test1) );

	}


	public function testGetUserActiveEcouponData()
	{

		$test1 = Ecoupon_logic::get_user_active_ecoupon_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_user_active_ecoupon_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::get_user_active_ecoupon_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}


	public function testEcouponContentToString()
	{

		$test1 = Ecoupon_logic::ecoupon_content_to_string( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::ecoupon_content_to_string( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Ecoupon_logic::ecoupon_content_to_string( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

}
