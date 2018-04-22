<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Option_logic;


class OptionLogic extends TestCase
{

    public function testGetStoreTypeName()
    {

		$test1 = Option_logic::get_store_type_name( "" );

		$this->assertFalse( $test1 );

		$test1 = Option_logic::get_store_type_name( 0 );

		$this->assertFalse( $test1 );

		$test1 = Option_logic::get_store_type_name( array() );

		$this->assertFalse( $test1 );

    }

    public function testGetInWarehouseCategory()
    {

		$test1 = Option_logic::get_in_warehouse_category();

		$this->assertTrue( is_object($test1) );

    }

    public function testGetOutWarehouseCategory()
    {

		$test1 = Option_logic::get_out_warehouse_category();

		$this->assertTrue( is_object($test1) );

    }

    public function testGetOption()
    {

		$test1 = Option_logic::get_option( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Option_logic::get_option( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Option_logic::get_option( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

    }

    public function testGetSelectOption()
    {

		$test1 = Option_logic::get_select_option( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Option_logic::get_select_option( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Option_logic::get_select_option( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

    }

}
