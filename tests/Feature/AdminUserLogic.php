<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Admin_user_logic;

class AdminUserLogic extends TestCase
{

	public function testInsertFormat()
	{

		$test1 = Admin_user_logic::insert_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::insert_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::insert_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testUpdateFormat()
	{

		$test1 = Admin_user_logic::update_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::update_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::update_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetUserRoleAuth()
	{

		$test1 = Admin_user_logic::get_user_role_auth( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_role_auth( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_role_auth( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddUserRoleFormat()
	{

		$test1 = Admin_user_logic::add_user_role_format( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::add_user_role_format( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::add_user_role_format( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetUser()
	{

		$test1 = Admin_user_logic::get_user( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::get_user( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::get_user( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetUserRoleById()
	{

		$test1 = Admin_user_logic::get_user_role_by_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_role_by_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_role_by_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testAddUser()
	{

		$test1 = Admin_user_logic::add_user( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::add_user( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::add_user( array() );

		$this->assertFalse( $test1 );

	}

	public function testEditUser()
	{

		$test1 = Admin_user_logic::edit_user( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::edit_user( 0, 0 );

		$this->assertFalse( $test1 );
		
		$test1 = Admin_user_logic::edit_user( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testAddUserRole()
	{

		$test1 = Admin_user_logic::add_user_role( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::add_user_role( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::add_user_role( array() );

		$this->assertFalse( $test1 );

	}

	public function testDeleteUserRole()
	{

		$test1 = Admin_user_logic::delete_user_role( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::delete_user_role( 0, 0 );

		$this->assertFalse( $test1 );
		
		$test1 = Admin_user_logic::delete_user_role( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetUserId()
	{

		$test1 = Admin_user_logic::get_user_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetUserIdByRole()
	{

		$test1 = Admin_user_logic::get_user_id_by_role( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_id_by_role( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_id_by_role( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetRandString()
	{

		$test1 = Admin_user_logic::get_rand_string( "" );

		$this->assertTrue( !empty($test1) );
		$this->assertTrue( strlen($test1) == 3 );

	}

	public function testCheckStoreCodeRepeat()
	{

		$test1 = Admin_user_logic::check_store_code_repeat( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Admin_user_logic::check_store_code_repeat( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Admin_user_logic::check_store_code_repeat( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

	}

	public function testCntChildAccount()
	{

		$test1 = Admin_user_logic::cnt_child_account();

		$this->assertTrue( is_array($test1) );

	}

	public function testIsAdmin()
	{

		$test1 = Admin_user_logic::is_admin( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::is_admin( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::is_admin( array() );

		$this->assertFalse( $test1 );

	}

	public function testIsSubAdmin()
	{

		$test1 = Admin_user_logic::is_admin( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::is_admin( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::is_admin( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetParentsId()
	{

		$test1 = Admin_user_logic::get_parents_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Admin_user_logic::get_parents_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

		$test1 = Admin_user_logic::get_parents_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_int($test1) );
		$this->assertEquals($test1, 0);

	}

	public function testInsertStore()
	{

		$test1 = Admin_user_logic::insert_store( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::insert_store( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::insert_store( array() );

		$this->assertFalse( $test1 );

	}

	public function testGetUserPhoto()
	{

		$test1 = Admin_user_logic::get_user_photo( "" );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

		$test1 = Admin_user_logic::get_user_photo( 0 );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

		$test1 = Admin_user_logic::get_user_photo( array() );

		$this->assertTrue( is_object($test1) );
		$this->assertEquals($test1, new \stdClass());

	}

	public function testEditUserPhoto()
	{

		$test1 = Admin_user_logic::edit_user_photo( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::edit_user_photo( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::edit_user_photo( array() );

		$this->assertFalse( $test1 );

	}

	public function testExtendUserDeadline()
	{

		$test1 = Admin_user_logic::extend_user_deadline( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::extend_user_deadline( 0, 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::extend_user_deadline( array(), array() );

		$this->assertFalse( $test1 );

	}

	public function testGetUserImage()
	{

		$test1 = Admin_user_logic::get_user_image( "" );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::get_user_image( 0 );

		$this->assertFalse( $test1 );

		$test1 = Admin_user_logic::get_user_image( array() );

		$this->assertFalse( $test1 );

	}

	public function testAccountVerify()
	{

		$test1 = Admin_user_logic::account_verify( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::account_verify( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::account_verify( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetRelUserId()
	{

		$test1 = Admin_user_logic::get_rel_user_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_rel_user_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_rel_user_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetExpiringUser()
	{

		$test1 = Admin_user_logic::get_expiring_user( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_expiring_user( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_expiring_user( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetUserByStoreId()
	{

		$test1 = Admin_user_logic::get_user_by_store_id( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_by_store_id( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_user_by_store_id( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testInviteCodeEncode()
	{

		$test1 = Admin_user_logic::invite_code_encode( "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Admin_user_logic::invite_code_encode( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Admin_user_logic::invite_code_encode( array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

	}

	public function testInviteCodeDecode()
	{

		$test1 = Admin_user_logic::invite_code_decode( "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Admin_user_logic::invite_code_decode( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Admin_user_logic::invite_code_decode( array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

	}

	public function testInviteRecord()
	{

		$test1 = Admin_user_logic::invite_record( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::invite_record( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::invite_record( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

	}

	public function testSendInviteCodeProcess()
	{

		$test1 = Admin_user_logic::send_invite_code_process( "", "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::send_invite_code_process( 0, 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::send_invite_code_process( array(), array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

	}

	public function testCheckInviteQualifications()
	{

		$test1 = Admin_user_logic::check_invite_qualifications( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::check_invite_qualifications( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

		$test1 = Admin_user_logic::check_invite_qualifications( array(), array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, false);

	}

	public function testUserListDataBind()
	{

		$test1 = Admin_user_logic::user_list_data_bind( "" );

		$this->assertTrue( is_array($test1) );

		$test1 = Admin_user_logic::user_list_data_bind( 0 );

		$this->assertTrue( is_array($test1) );

		$test1 = Admin_user_logic::user_list_data_bind( array() );

		$this->assertTrue( is_array($test1) );

	}

	public function testGetBuySpecData()
	{

		$test1 = Admin_user_logic::get_buy_spec_data( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_buy_spec_data( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Admin_user_logic::get_buy_spec_data( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testGetAdminInputTemplateArray()
	{

		$test1 = Admin_user_logic::get_admin_input_template_array();

		$this->assertTrue( is_array($test1) );

	}

	public function testAdminInputDataBind()
	{

		$test1 = Admin_user_logic::admin_input_data_bind( "", "" );

		$this->assertEquals($test1, "");

		$test1 = Admin_user_logic::admin_input_data_bind( 0, 0 );

		$this->assertEquals($test1, 0);

		$test1 = Admin_user_logic::admin_input_data_bind( array(), array() );

		$this->assertEquals($test1, array());

	}

}
