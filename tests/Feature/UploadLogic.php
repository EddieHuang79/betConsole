<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\logic\Upload_logic;


class UploadTest extends TestCase
{

    public function test_upload_data_en_int()
    {

    	$data = "";

    	$select_option = "";

    	$result = Upload_logic::upload_data_en_int( $data, $select_option );

    	$this->assertEquals($result, array());
        

    	$data = array(1,2,3);

    	$select_option = "";

    	$result = Upload_logic::upload_data_en_int( $data, $select_option );

    	$this->assertEquals($result, array());


    	$data = "";

    	$select_option = "1";

    	$result = Upload_logic::upload_data_en_int( $data, $select_option );

    	$this->assertEquals($result, array());
    	

        $this->assertTrue(true);
    
    }

    public function testProductUploadFormat()
    {

        $test1 = Upload_logic::product_upload_format( "" );

        $this->assertTrue( true );

    }

    public function testPurchaseUploadFormat()
    {

        $test1 = Upload_logic::purchase_upload_format( "" );

        $this->assertTrue( true );

    }

    public function testOrderUploadFormat()
    {

        $test1 = Upload_logic::order_upload_format( "" );

        $this->assertTrue( true );

    }

    public function testColumnNameToEnglish()
    {

        $test1 = Upload_logic::column_name_to_english( "", "" );

        $this->assertTrue( empty($test1) );
        $this->assertTrue( is_array($test1) );
        $this->assertEquals($test1, array());

        $test1 = Upload_logic::column_name_to_english( 0, 0 );

        $this->assertTrue( empty($test1) );
        $this->assertTrue( is_array($test1) );
        $this->assertEquals($test1, array());

        $test1 = Upload_logic::column_name_to_english( array(), array() );

        $this->assertTrue( empty($test1) );
        $this->assertTrue( is_array($test1) );
        $this->assertEquals($test1, array());

    }

    public function testGetProductUploadInputTemplateArray()
    {

        $test1 = Upload_logic::get_product_upload_input_template_array();

        $this->assertTrue( is_array($test1) );

    }

    public function testGetPurchaseUploadInputTemplateArray()
    {

        $test1 = Upload_logic::get_purchase_upload_input_template_array();

        $this->assertTrue( is_array($test1) );

    }

    public function testGetOrderUploadInputTemplateArray()
    {

        $test1 = Upload_logic::get_order_upload_input_template_array();

        $this->assertTrue( is_array($test1) );

    }

}
