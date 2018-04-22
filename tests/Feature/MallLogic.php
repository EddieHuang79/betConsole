<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Mall_logic;

class MallLogic extends TestCase
{


	public function testInsertFormat()
	{

		$test1 = Mall_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInsertSpecFormat()
	{

		$test1 = Mall_logic::insert_spec_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_spec_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_spec_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInsertChildProductFormat()
	{

		$test1 = Mall_logic::insert_child_product_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_child_product_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::insert_child_product_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Mall_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddMallShop()
	{

		$test1 = Mall_logic::add_mall_shop( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_shop( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_shop( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditMallShop()
	{

		$test1 = Mall_logic::add_mall_shop( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_shop( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_shop( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testAddMallProductSpec()
	{

		$test1 = Mall_logic::add_mall_product_spec( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_product_spec( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_mall_product_spec( array() );

		$this->assertFalse( $test1 );

	}

	public function testDelMallProductSpec()
	{

		$test1 = Mall_logic::del_mall_product_spec( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::del_mall_product_spec( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::del_mall_product_spec( array() );

		$this->assertFalse( $test1 );

	}

	public function testAddChildProduct()
	{

		$test1 = Mall_logic::add_child_product( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_child_product( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::add_child_product( array() );

		$this->assertFalse( $test1 );

	}

	public function testDelChildProduct()
	{

		$test1 = Mall_logic::del_child_product( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::del_child_product( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::del_child_product( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetSingleMall()
	{

		$test1 = Mall_logic::get_single_mall( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::get_single_mall( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::get_single_mall( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetMallServiceList()
	{

		$test1 = Mall_logic::get_mall_service_list( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Mall_logic::get_mall_service_list( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Mall_logic::get_mall_service_list( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetMallServiceRel()
	{

		$test1 = Mall_logic::get_mall_service_rel( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::get_mall_service_rel( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Mall_logic::get_mall_service_rel( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetMallImage()
	{

		$test1 = Mall_logic::get_mall_image( "" );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::get_mall_image( 0 );

		$this->assertFalse( $test1 );

		$test1 = Mall_logic::get_mall_image( array() );

		$this->assertFalse( $test1 );

	}

	public function testMallListDataBind()
	{

		$test1 = Mall_logic::mall_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Mall_logic::mall_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Mall_logic::mall_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

}
