<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Login;

class LoginLogic extends TestCase
{

	public function testLoginFormat()
	{

		$test1 = Login::login_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Login::login_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Login::login_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testLoginVerify()
	{

		$test1 = Login::login_verify( "" );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Login::login_verify( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

		$test1 = Login::login_verify( array() );

		$this->assertTrue( empty($test1) );
		$this->assertEquals($test1, "");

	}

	public function testLoginSessionFormat()
	{

		$test1 = Login::login_session_format( "", "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Login::login_session_format( 0, 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Login::login_session_format( array(), array(0) );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testIsUserLogin()
	{

		$test1 = Login::is_user_login();

		$this->assertFalse( $test1 );

	}

	public function testGetLoginUserData()
	{

		$test1 = Login::get_login_user_data();

		$this->assertTrue( empty($test1) );

	}

	public function testLogout()
	{

		$test1 = Login::logout();

		$this->assertTrue( true );

	}
}
