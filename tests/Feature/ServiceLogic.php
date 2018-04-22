<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Service_logic;


class ServiceLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Service_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Service_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetServiceRoleAuth()
	{

		$test1 = Service_logic::get_service_role_auth( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_service_role_auth( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_service_role_auth( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testMenuFormat()
	{

		$test1 = Service_logic::menu_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::menu_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::menu_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetParentsName()
	{

		$test1 = Service_logic::get_parents_name( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_parents_name( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_parents_name( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testRoleAuthFormat()
	{

		$test1 = Service_logic::role_auth_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::role_auth_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::role_auth_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAuthCheck()
	{

		$test1 = Service_logic::auth_check( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::auth_check( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::auth_check( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetService()
	{

		$test1 = Service_logic::get_service( "" );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Service_logic::get_service( 0 );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Service_logic::get_service( array() );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

	}

	public function testMenuList()
	{

		$test1 = Service_logic::menu_list( "" );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Service_logic::menu_list( 0 );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Service_logic::menu_list( array() );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

	}

	public function testAddService()
	{

		$test1 = Service_logic::add_service( "" );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::add_service( 0 );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::add_service( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditService()
	{

		$test1 = Service_logic::edit_service( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::edit_service( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::edit_service( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetServiceIdByRole()
	{

		$test1 = Service_logic::get_service_id_by_role( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_service_id_by_role( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::get_service_id_by_role( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetServiceIdByUrlAndSave()
	{

		$test1 = Service_logic::get_service_id_by_url_and_save( "" );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::get_service_id_by_url_and_save( 0 );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::get_service_id_by_url_and_save( array() );

		$this->assertFalse( $test1 );

	}

	public function testPublicService()
	{

		$test1 = Service_logic::public_service( "" );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::public_service( 0 );

		$this->assertFalse( $test1 );

		$test1 = Service_logic::public_service( array() );

		$this->assertFalse( $test1 );

	}

	public function testBreadcrumb()
	{

		$test1 = Service_logic::breadcrumb( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::breadcrumb( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Service_logic::breadcrumb( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testServiceListDataBind()
	{

		$test1 = Service_logic::service_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Service_logic::service_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Service_logic::service_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetServiceInputTemplateArray()
	{

		$test1 = Service_logic::get_service_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testServiceInputDataBind()
	{

		$test1 = Service_logic::service_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Service_logic::service_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Service_logic::service_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
