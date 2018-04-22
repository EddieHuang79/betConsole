<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Product_logic;

class ProductLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Product_logic::insert_main_format( 1 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInsertExtraFormat()
	{

		$test1 = Product_logic::insert_extra_format( array(), array(), 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Product_logic::update_main_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateExtraFormat()
	{

		$test1 = Product_logic::update_extra_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddProduct()
	{

		$test1 = Product_logic::add_product( array() );

		$this->assertFalse( $test1 );

	}

	public function testAddExtraProduct()
	{

		$test1 = Product_logic::add_extra_data( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditProduct()
	{

		$test1 = Product_logic::edit_product( array(), "" );

		$this->assertFalse( $test1 );

	}

	public function testEditExtraProduct()
	{

		$test1 = Product_logic::edit_product_extra_data( array(), "" );

		$this->assertFalse( $test1 );

	}

	public function testGetProductExtraColumn()
	{

		$test1 = Product_logic::get_product_extra_column();

		$this->assertTrue( true );

	}

	public function testGetProductSpecColumn()
	{

		$test1 = Product_logic::get_product_spec_column();

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetProductData()
	{

		$test1 = Product_logic::get_product_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::get_product_data( array() );

		$this->assertTrue( true );

	}

	public function testGetProductList()
	{

		$test1 = Product_logic::get_product_list( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::get_product_list( array(), 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::get_product_list( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::get_product_list( array(1), array(1) );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetSingleProduct()
	{

		$test1 = Product_logic::get_single_product( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetProductSpec()
	{

		$test1 = Product_logic::get_single_product( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetProductAutocomplete()
	{

		$test1 = Product_logic::product_autocomplete( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetProductIdFromCollection()
	{

		$test1 = Product_logic::get_product_id_from_collection( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Product_logic::get_product_id_from_collection( array(1) );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, 0);

	}

	public function testProductUploadSampleOutput()
	{

		$test1 = Product_logic::product_upload_sample_output( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Product_logic::product_upload_sample_output( array(0) );

		$this->assertTrue( is_array($test1) );

	}

	public function testProductSpecHeaderDownloadFormat()
	{

		$test1 = Product_logic::product_spec_header_download_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::product_spec_header_download_format( array(0) );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Product_logic::product_spec_header_download_format( array(1) );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testProductListDataBind()
	{

		$test1 = Product_logic::product_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Product_logic::product_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Product_logic::product_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetProductInputTemplateArray()
	{

		$test1 = Product_logic::get_product_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testProductInputDataBind()
	{

		$test1 = Product_logic::product_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Product_logic::product_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Product_logic::product_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
