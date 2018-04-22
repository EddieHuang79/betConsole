<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\ProductCategory_logic;

class ProductCategoryLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = ProductCategory_logic::insert_main_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::insert_main_format( 1 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::insert_main_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = ProductCategory_logic::update_main_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::update_main_format( 1 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::update_main_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetAllCategoryList()
	{

		$test1 = ProductCategory_logic::get_all_category_list();

		$this->assertTrue( is_array($test1) );

	}

	public function testGetParentsCategoryList()
	{

		$test1 = ProductCategory_logic::get_parents_category_list();

		$this->assertTrue( is_array($test1) );

	}

	public function testGetSingleProductCategory()
	{

		$test1 = ProductCategory_logic::get_single_product_category( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_single_product_category( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_single_product_category( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddProductCategory()
	{

		$test1 = ProductCategory_logic::add_product_category( "" );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::add_product_category( 0 );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::add_product_category( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditProductCategory()
	{

		$test1 = ProductCategory_logic::edit_product_category( "", "" );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::edit_product_category( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::edit_product_category( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetChildProductCategory()
	{

		$test1 = ProductCategory_logic::get_child_product_category( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_child_product_category( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_child_product_category( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetParentsCategoryId()
	{

		$test1 = ProductCategory_logic::get_parents_category_id( "" );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::get_parents_category_id( 0 );

		$this->assertFalse( $test1 );

		$test1 = ProductCategory_logic::get_parents_category_id( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetMutliParentsCategoryId()
	{

		$test1 = ProductCategory_logic::get_mutli_parents_category_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_mutli_parents_category_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ProductCategory_logic::get_mutli_parents_category_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetParentsIdNameTrans()
	{

		$test1 = ProductCategory_logic::get_parents_id_name_trans( );

		$this->assertTrue( is_array($test1) );

	}

	public function testProductCategoryListDataBind()
	{

		$test1 = ProductCategory_logic::product_category_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = ProductCategory_logic::product_category_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = ProductCategory_logic::product_category_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetMsgInputTemplateArray()
	{

		$test1 = ProductCategory_logic::get_product_category_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testMsgInputDataBind()
	{

		$test1 = ProductCategory_logic::product_category_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = ProductCategory_logic::product_category_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = ProductCategory_logic::product_category_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
