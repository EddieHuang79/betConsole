<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\logic\Product_logic;
use App\logic\Option_logic;
use App\logic\ProductCustom_logic;

class ProductUpload extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductUpload()
    {

    	$option_data = array();

    	$data = array();

    	$txt_data = array();


    	for ($i=1; $i <= 1000; $i++) 
    	{ 

			$data[] = array(

							"product_name"				=>	"Product_".$i,
							"safe_amount"				=>	200,
							"shop_id"					=>	1,
							"qc_number"					=>	"qc_number_".$i,
							"category"					=>	mt_rand(3,8),
							"barcode"					=>	mt_rand(11111111,99999999),
							"keep_for_days"				=>	111,
						);

    	}

    	
		$extra_column = Product_logic::get_product_extra_column();

		foreach ($data as $row) 
		{

			$main_data = Product_logic::insert_main_format( $row );

			$product_id = Product_logic::add_product( $main_data );

			$extra_data = Product_logic::insert_extra_format( $row, $extra_column, $product_id );

			Product_logic::add_extra_data( $extra_data );

		}

        $this->assertTrue(true);
   
    }

}
