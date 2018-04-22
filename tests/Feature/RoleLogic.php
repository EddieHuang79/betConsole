<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Role_logic;

class RoleLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Role_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Role_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddRoleServiceFormat()
	{

		$test1 = Role_logic::add_role_service_format( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::add_role_service_format( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::add_role_service_format( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetRole()
	{

		$test1 = Role_logic::get_role( "" );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Role_logic::get_role( 0 );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

		$test1 = Role_logic::get_role( array() );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass);

	}

	public function testAddRole()
	{

		$test1 = Role_logic::add_role( "" );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::add_role( 0 );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::add_role( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditRole()
	{

		$test1 = Role_logic::edit_role( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::edit_role( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::edit_role( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testAddRoleService()
	{

		$test1 = Role_logic::add_role_service( "" );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::add_role_service( 0 );

		$this->assertFalse( $test1 );

		$test1 = Role_logic::add_role_service( array() );

		$this->assertFalse( $test1 );

	}

	public function testFilterAdminRole()
	{

		$test1 = Role_logic::filter_admin_role( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::filter_admin_role( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Role_logic::filter_admin_role( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetRoleArray()
	{

		$test1 = Role_logic::get_role_array();

		$this->assertTrue( is_array($test1) );
	
	}

	public function testRoleListDataBind()
	{

		$test1 = Role_logic::role_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Role_logic::role_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Role_logic::role_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetRoleInputTemplateArray()
	{

		$test1 = Role_logic::get_role_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testRoleInputDataBind()
	{

		$test1 = Role_logic::role_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Role_logic::role_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Role_logic::role_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
