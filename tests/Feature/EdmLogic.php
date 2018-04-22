<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Edm_logic;

class EdmLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Edm_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Edm_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddEdm()
	{

		$test1 = Edm_logic::add_edm( "" );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::add_edm( 0 );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::add_edm( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditEdm()
	{

		$test1 = Edm_logic::edit_edm( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::edit_edm( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::edit_edm( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetSingleEdm()
	{

		$test1 = Edm_logic::get_single_edm( "" );

		$this->assertEquals($test1, new \stdClass);

		$test1 = Edm_logic::get_single_edm( 0 );

		$this->assertEquals($test1, new \stdClass);

		$test1 = Edm_logic::get_single_edm( array() );

		$this->assertEquals($test1, new \stdClass);

	}

	public function testCloneEdm()
	{

		$test1 = Edm_logic::clone_edm( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::clone_edm( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Edm_logic::clone_edm( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testChangeStatus()
	{

		$test1 = Edm_logic::change_status( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::change_status( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Edm_logic::change_status( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testEdmListDataBind()
	{

		$test1 = Edm_logic::edm_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testEdmVerifyListDataBind()
	{

		$test1 = Edm_logic::edm_verify_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_verify_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_verify_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testEdmCancelListDataBind()
	{

		$test1 = Edm_logic::edm_cancel_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_cancel_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Edm_logic::edm_cancel_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetAdminInputTemplateArray()
	{

		$test1 = Edm_logic::get_edm_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testAdminInputDataBind()
	{

		$test1 = Edm_logic::edm_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Edm_logic::edm_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Edm_logic::edm_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
