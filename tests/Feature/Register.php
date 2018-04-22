<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Register as Register_logic;

class Register extends TestCase
{

	public function testRegisterFormat()
	{

		$test1 = Register_logic::register_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Register_logic::register_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Register_logic::register_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testRegisterProcess()
	{

		$test1 = Register_logic::register_process( "" );

		$this->assertEquals($test1, json_encode( array(0) ));

		$test1 = Register_logic::register_process( 0 );

		$this->assertEquals($test1, json_encode( array(0) ));

		$test1 = Register_logic::register_process( array() );

		$this->assertEquals($test1, json_encode( array(0) ));

	}

	public function testSocialFormat()
	{

		$test1 = Register_logic::social_format( "" );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Register_logic::social_format( 0 );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

		$test1 = Register_logic::social_format( array() );

		$this->assertTrue( empty($test1) );
		$this->assertTrue( is_array($test1) );
		$this->assertEquals($test1, array());

	}

	public function testSendRegisterWmail()
	{

		$test1 = Register_logic::send_register_email( "" );

		$this->assertFalse( $test1 );

		$test1 = Register_logic::send_register_email( 0 );

		$this->assertFalse( $test1 );

		$test1 = Register_logic::send_register_email( array() );

		$this->assertFalse( $test1 );

	}

}
