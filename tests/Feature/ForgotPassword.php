<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\ForgotPassword as ForgotPassword_logic;

class ForgotPassword extends TestCase
{

	public function testPasswordResetFormat()
	{

		$test1 = ForgotPassword_logic::password_reset_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ForgotPassword_logic::password_reset_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = ForgotPassword_logic::password_reset_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testPasswordResetVerify()
	{

		$test1 = ForgotPassword_logic::password_reset_verify( "" );

		$this->assertEquals($test1, json_encode(array("error")));

		$test1 = ForgotPassword_logic::password_reset_verify( 0 );

		$this->assertEquals($test1, json_encode(array("error")));

		$test1 = ForgotPassword_logic::password_reset_verify( array() );

		$this->assertEquals($test1, json_encode(array("error")));

	}


}
