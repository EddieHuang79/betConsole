<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Purchase_logic;

class PurchaseLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Purchase_logic::insert_format( 1 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInsertExtraFormat()
	{

		$test1 = Purchase_logic::insert_extra_format( array(), array(), 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Purchase_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateExtraFormat()
	{

		$test1 = Purchase_logic::update_extra_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetInWarehouseNumber()
	{

		$test1 = Purchase_logic::get_in_warehouse_number( 0 );

		$this->assertFalse( $test1 );

	}

	public function testAddPurchase()
	{

		$test1 = Purchase_logic::add_purchase( 0 );

		$this->assertFalse( $test1 );

	}

	public function testAddExtraPurchase()
	{

		$test1 = Purchase_logic::add_extra_purchase( 0 );

		$this->assertFalse( $test1 );

	}

	public function testEditPurchase()
	{

		$test1 = Purchase_logic::edit_purchase( 0, 0 );

		$this->assertFalse( $test1 );

	}

	public function testEditPurchaseExtraData()
	{

		$test1 = Purchase_logic::edit_purchase_extra_data( 0, 0 );

		$this->assertFalse( $test1 );

	}

	public function testGetPurchaseData()
	{

		$test1 = Purchase_logic::get_purchase_data();

		$this->assertTrue( true );

	}

	public function testGetPurchaseList()
	{

		$test1 = Purchase_logic::get_purchase_list( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::get_purchase_list( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::get_purchase_list( array(1), array(1) );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetSinglePurchaseData()
	{

		$test1 = Purchase_logic::get_single_purchase_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetPurchaseStockData()
	{

		$test1 = Purchase_logic::get_purchase_stock_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::get_purchase_stock_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::get_purchase_stock_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testPurchaseVerify()
	{

		$test1 = Purchase_logic::purchase_verify( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::purchase_verify( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Purchase_logic::purchase_verify( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetPurchaseExtraColumn()
	{

		$test1 = Purchase_logic::get_purchase_extra_column();

		$this->assertTrue( is_array($test1) );

	}

	public function testPurchaseUploadSampleOutput()
	{

		$test1 = Purchase_logic::purchase_upload_sample_output( array() );

		$this->assertTrue( is_array($test1) );

		$test1 = Purchase_logic::purchase_upload_sample_output( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Purchase_logic::purchase_upload_sample_output( 0 );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetPurchaseSum()
	{

		$test1 = Purchase_logic::get_purchase_sum( array(), array(), array() );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

		$test1 = Purchase_logic::get_purchase_sum( "", "", "" );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

		$test1 = Purchase_logic::get_purchase_sum( 0, 0, 0 );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

	}

	public function testGetProductInputTemplateArray()
	{

		$test1 = Purchase_logic::get_purchase_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testProductInputDataBind()
	{

		$test1 = Purchase_logic::purchase_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Purchase_logic::purchase_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Purchase_logic::purchase_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
