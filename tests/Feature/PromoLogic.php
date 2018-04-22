<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Promo_logic;

class PromoLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Promo_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Promo_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddPromoData()
	{

		$test1 = Promo_logic::add_promo_data( "" );

		$this->assertFalse( $test1 );

		$test1 = Promo_logic::update_format( 0 );

		// $this->assertFalse( $test1 );

		$test1 = Promo_logic::update_format( array() );

		// $this->assertFalse( $test1 );

	}

	public function testEditPromoData()
	{

		$test1 = Promo_logic::edit_promo_data( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Promo_logic::edit_promo_data( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Promo_logic::edit_promo_data( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetPromoPrice()
	{

		$test1 = Promo_logic::get_promo_price( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::get_promo_price( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::get_promo_price( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetSinglePromoData()
	{

		$test1 = Promo_logic::get_single_promo_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::get_single_promo_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Promo_logic::get_single_promo_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testIsPromoDateRepeat()
	{

		$test1 = Promo_logic::is_promo_date_repeat( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Promo_logic::is_promo_date_repeat( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Promo_logic::is_promo_date_repeat( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetActivePromoPrice()
	{

		$test1 = Promo_logic::get_active_promo_price( "" );

		$this->assertEquals( $test1, 0 );

		$test1 = Promo_logic::get_active_promo_price( 0 );

		$this->assertEquals( $test1, 0 );

		$test1 = Promo_logic::get_active_promo_price( array() );

		$this->assertEquals( $test1, 0 );

	}

	public function testGetPromoInputTemplateArray()
	{

		$test1 = Promo_logic::get_promo_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testPromoInputDataBind()
	{

		$test1 = Promo_logic::promo_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Promo_logic::promo_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Promo_logic::promo_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

	public function testPromoListDataBind()
	{

		$test1 = Promo_logic::promo_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Promo_logic::promo_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Promo_logic::promo_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

}
