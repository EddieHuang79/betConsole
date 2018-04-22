<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Store_logic;

class StoreLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Store_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Store_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testEditStore()
	{

		$test1 = Store_logic::edit_store( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::edit_store( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::edit_store( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testAddStore()
	{

		$test1 = Store_logic::add_store( "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::add_store( 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::add_store( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetSingleStore()
	{

		$test1 = Store_logic::get_single_store( "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::get_single_store( 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::get_single_store( array() );

		$this->assertFalse( $test1 );

	}

	public function testCheckStoreUser()
	{

		$test1 = Store_logic::check_store_user( "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::check_store_user( 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::check_store_user( array() );

		$this->assertFalse( $test1 );

	}

	public function testChangeStore()
	{

		$test1 = Store_logic::change_store( "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::change_store( 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::change_store( array() );

		$this->assertFalse( $test1 );

	}

	public function testExtendStoreDeadline()
	{

		$test1 = Store_logic::change_store( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::change_store( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::change_store( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetStoreIdByCode()
	{

		$test1 = Store_logic::get_store_id_by_code( "" );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::get_store_id_by_code( 0 );

		$this->assertFalse( $test1 );

		$test1 = Store_logic::get_store_id_by_code( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetRelShopId()
	{

		$test1 = Store_logic::get_rel_shop_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::get_rel_shop_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Store_logic::get_rel_shop_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testStoreListDataBind()
	{

		$test1 = Store_logic::store_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Store_logic::store_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Store_logic::store_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	// public function testGetStoreInputTemplateArray()
	// {

	// 	$test1 = Store_logic::get_store_input_template_array();

	// 	$this->assertTrue( is_array($test1) );

	// }

	// public function testStoreInputDataBind()
	// {

	// 	$test1 = Store_logic::store_input_data_bind( "", "" );

	// 	$this->assertEquals($test1, "");

	// 	$test1 = Store_logic::store_input_data_bind( 0, 0 );

	// 	$this->assertEquals($test1, 0);

	// 	$test1 = Store_logic::store_input_data_bind( array(), array() );

	// 	$this->assertEquals($test1, array());

	// }

}
