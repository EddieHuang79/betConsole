<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\logic\Record_logic;

class RecordLogic extends TestCase
{

    public function testWriteLog()
    {

		$test1 = Record_logic::write_log( "", "" );

		$this->assertFalse( $test1 );

		$test1 = Record_logic::write_log( 0, 0 );

		$this->assertFalse( $test1 );

    }

    public function testGetLog()
    {

		$test1 = Record_logic::get_log();

		$this->assertTrue( is_array($test1) );

    }

}
