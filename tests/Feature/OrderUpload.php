<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\logic\Option_logic;
use App\logic\Order_logic;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factory;
use App\logic\OrderCustom_logic;
use App\logic\StockCustom_logic;
use App\logic\ProductCustom_logic;
use Illuminate\Support\Facades\Session;

class OrderUpload extends TestCase
{

    // 模擬正式訂單流程

    public function testUserCreateOrder()
    {

        $user_order = array();

        $order_id_array = array();

        $order_cnt = 3;

        $order_extra_column = order_logic::get_order_extra_column();

        $faker = \Faker\Factory::create();

        $player_name = str_replace(" ", "", $faker->name);
        $player_name = str_replace(".", "", $player_name);
        $player_name = str_replace("'", "", $player_name);
        $player_name = strtoupper($player_name);

        for ($i=0; $i < 1000; $i++) 
        { 

            // 選擇球隊、球衣類型、背號、姓名、數量

            $user_order = array(
                                "shop_id"               => 1,
                                "product_name"          => "Product_".mt_rand(1,1000),
                                "spec_id"               => 0,
                                "number"                => mt_rand(1,3),
                                "out_warehouse_date"    => date('Y-m-d', mktime(0,0,0,1,1+mt_rand(0,364),date("Y"))),
                                "category"              => 1,
                            );

            // 新增主商品

            $insert_data = Order_logic::insert_format( $user_order );

            $order_id = Order_logic::add_order( $insert_data );

            $extra_data = Order_logic::insert_extra_format( $user_order, $order_extra_column, $order_id );

            Order_logic::add_extra_order( $extra_data );

            $order_id_array[] = $order_id;

        }


        // 扣除庫存

        Order_logic::order_verify( $order_id_array );

        $this->assertTrue(true);

    }

    // //  測試 FIFO Core function 1 by 1 assertTrue

    // public function testFIFOFunction_1()
    // {

    //     // 產生case

    //     $stock_data = array();

    //     $rand_data = array();

    //     $seed = mt_rand(1, 10);

    //     for ($i=0; $i < $seed; $i++) 
    //     { 

    //         $stock_key = implode("-",  array($i, 0) );

    //         $stock = array();

    //         for ( $j=1; $j <= $seed; $j++ ) 
    //         { 
                
    //             $stock[$j] = array( $j => 1 );

    //         }

    //         $rand_data[] = array(
    //                             "request_number"    => $seed,
    //                             "stock_key"         => $stock_key,
    //                             "data"              => $stock
    //                         );

    //     }

        
    //     foreach ($rand_data as $row) 
    //     {

    //         $request_number = $row["request_number"];

    //         $stock_key = $row["stock_key"];

    //         $stock_data[$stock_key] = $row["data"];

    //         // $stock_data[$stock_key][1] = array(
    //         //                                         1 => 1
    //         //                             );
    //         // $stock_data[$stock_key][2] = array(
    //         //                                         2 => 2
    //         //                             );

    //         // 測試開始


    //         Session::forget('stock_data');

    //         Session::put('stock_data', $stock_data);

    //         $result = Order_logic::FIFO_stock( $stock_key, $request_number ) ;

    //         // 正確的case result = true, data每個值都要 > 0, 剩餘庫存資料必須 >= 0

    //         $this->assertTrue($result["result"]);

    //         foreach ($result["data"] as $row) 
    //         {

    //             $this->assertGreaterThan( 0, $row);
            
    //         }

    //         $stock_data = Session::get('stock_data');

    //         foreach ($stock_data as $row) 
    //         {

    //             foreach ($row as $key => $value) 
    //             {
                
    //                 $this->assertGreaterThan( -1, $key);

    //                 $this->assertGreaterThan( -1, $value);

    //             }

    //         }


    //     }

    // }

    // //  測試 FIFO Core function rand stock

    // public function testFIFOFunction_2()
    // {

    //     // 產生case

    //     $stock_data = array();

    //     $rand_data = array();

    //     // $send_array = array( 1, 3, 5, 7, 9 );
    //     $send_array = array( 16, 15, 14, 13, 12 );

    //     $seed = $send_array[ mt_rand(0, 4) ];

        
    //     for ($i=0; $i < $seed; $i++) 
    //     { 

    //         $stock_sum = 0 ;

    //         $stock_key = implode("-",  array($i, 0) );

    //         $stock = array();

    //         $stock_cnt = ceil($seed/3);

    //         for ( $j=1; $j <= $stock_cnt; $j++ ) 
    //         { 

    //             // $number = ceil( $seed/3 );
    //             // $number = mt_rand( 0 , 5 );
    //             $number = 500;
                
    //             $stock[$j] = array( $j => $number );

    //             $stock_sum += $number ;
 
    //         }

    //         $rand_data[] = array(
    //                             "stock_sum"         => $stock_sum,
    //                             "request_number"    => $seed,
    //                             "stock_key"         => $stock_key,
    //                             "data"              => $stock
    //                         );

    //     }

    //     print_r($rand_data);


        
    //     foreach ($rand_data as $row) 
    //     {

    //         $request_number = $row["request_number"];

    //         $stock_sum = $row["stock_sum"];

    //         $stock_key = $row["stock_key"];

    //         $stock_data[$stock_key] = $row["data"];

    //         print_r( $request_number ."vs". $stock_sum);

    //         echo "\r\n";

    //         // $stock_data[$stock_key][1] = array(
    //         //                                         1 => 1
    //         //                             );
    //         // $stock_data[$stock_key][2] = array(
    //         //                                         2 => 2
    //         //                             );

    //         // 測試開始


    //         Session::forget('stock_data');

    //         Session::put('stock_data', $stock_data);

    //         $result = Order_logic::FIFO_stock( $stock_key, $request_number ) ;

    //         // 正確的case result = true, data每個值都要 > 0, 剩餘庫存資料必須 >= 0

    //         if ( $request_number <= $stock_sum ) 
    //         {

    //             echo "true";
    //             echo "\r\n";

    //             $this->assertTrue($result["result"]);

    //             foreach ($result["data"] as $row) 
    //             {

    //                 $this->assertGreaterThan( 0, $row);
                
    //             }

    //             $stock_data = Session::get('stock_data');

    //             foreach ($stock_data as $row) 
    //             {

    //                 foreach ($row as $key => $value) 
    //                 {
                    
    //                     $this->assertGreaterThan( -1, $key);

    //                     $this->assertGreaterThan( -1, $value);

    //                 }

    //             }

    //         }
    //         else
    //         {

    //             echo "false";
    //             echo "\r\n";

    //             $this->assertFalse($result["result"]);

    //             $this->assertEmpty($result["data"]);

    //             $stock_data = Session::get('stock_data');

    //             foreach ($stock_data as $row) 
    //             {

    //                 foreach ($row as $key => $value) 
    //                 {
                    
    //                     $this->assertGreaterThan( -1, $key);

    //                     $this->assertGreaterThan( -1, $value);

    //                 }

    //             }

    //         }
            



    //     }

    // }

    // //  測試 FIFO Master function

    // public function testFIFOFunction_3()
    // {

    //     // 產生case

    //     $stock_data = array();

    //     $rand_data = array();

    //     // $send_array = array( 1, 3, 5, 7, 9 );
    //     $send_array = array( 16, 15, 14, 13, 12 );

    //     $seed = $send_array[ mt_rand(0, 4) ];

        
    //     for ($i=1; $i < $seed; $i++) 
    //     { 

    //         $tmp = new \stdClass();

    //         $tmp->product_id = mt_rand( 1, 4440 );
    //         $tmp->spec_id = 0;
    //         $tmp->number = mt_rand( 200, 300 );

    //         $rand_data[1][$i] = $tmp;

    //     }

    //     print_r($rand_data);
    //     echo "\r\n";

    //     $result = Order_logic::FIFO_get_stock_id( $rand_data );

    //     foreach ($result as $order_id => $row) 
    //     {

    //         if ( $row["result"] === true ) 
    //         {

    //             echo "true";
    //             echo "\r\n";


    //             foreach ($row["data"] as $row2) 
    //             {

    //                 $this->assertTrue($row2["result"]);

    //                 foreach ($row2["data"] as $stock_id => $request_number) 
    //                 {

    //                     $this->assertGreaterThan( 0, $request_number);

    //                 }

    //             }

    //         }
    //         else
    //         {

    //             echo "false";
    //             echo "\r\n";

    //             $this->assertFalse($row["result"]);

    //             $this->assertEmpty($row["data"]);

    //         }

    //     }

        
    // }



    protected function get_product()
    {

    	$result = array();

    	$data = DB::table("product")
    				->select(
    						"product.product_name",
    						"product_extra.tshirt_type",
    						"product_extra.team"
    					)
    				->leftJoin("product_extra", 'product_extra.product_id', '=', 'product.id')
    				->where("product_type", "=", "1")
    				->get();

    	foreach ($data as $row) 
    	{

    		$result[$row->team][$row->tshirt_type] = array(
    													"product_name" 	=> $row->product_name,
    													"spec_id" 		=> 0
    												);

    	}

    	return $result;

    }

    protected function get_order_list()
    {

    	$result = array();

    	$data = DB::table("order")
    				->select(
    						"order.id",
    						"order.number",
    						"order.order_number",
    						"order.out_warehouse_date",
    						"order.category",
    						"order_extra.player_name",
    						"order_extra.player_number",
    						"product_extra.tshirt_type",
    						"product_extra.team"
    					)
    				->leftJoin("order_extra", 'order_extra.order_id', '=', 'order.id')
    				->leftJoin("product_extra", 'product_extra.product_id', '=', 'order.product_id')
    				->where("product_type", "=", "1")
    				->where("status", "=", "1")
    				->get();


    	return $data;

    }

}
