<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\logic\Purchase_logic;
use App\logic\Stock_logic;

class PurchaseUpload extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPurchaseUpload()
    {
    
    	$purchase_extra_column = Purchase_logic::get_purchase_extra_column();

    	// 隨機產生庫存

    	for ($i=1; $i <= 1000; $i++) 
        { 
            // 隨機產生庫存

            $data = array(
                            "product_name"            => "Product_".$i,
                            "shop_id"                 => 1,
                            // "product_id"              => mt_rand(4, 1003),
                            "spec_id"                 => 0,
                            "number"                  => mt_rand(5,10),
                            "in_warehouse_date"       => date('Y-m-d', mktime(0,0,0,1,1+mt_rand(0,364),date("Y"))),
                            "category"                => 1,
                            "warehouse_id"            => 1,
                        );

            $insert_data = Purchase_logic::insert_format( $data );

            $purchase_id = Purchase_logic::add_purchase( $insert_data );

            $extra_data = Purchase_logic::insert_extra_format( $data, $purchase_extra_column, $purchase_id );

            Purchase_logic::add_extra_purchase( $extra_data );

        }

        $this->assertTrue(true);
    
    }


    public function testPurchaseVerify()
    {
    
        $data = array();

        $purchase_id = array();

        // 撈出所有進貨id

        $purchase_data = $this->get_all_purchase_id();

        foreach ($purchase_data as $row) 
        {

            $purchase_id[] = $row->id;

        }

        // filter

        $purchase_id_array = array_filter($purchase_id, "intval");

        // 取得入庫數量

        $purchase_data = Purchase_logic::get_purchase_stock_data( $purchase_id_array ); 

        // 入庫格式

        $data = Stock_logic::insert_format( $purchase_data );

        // 入庫

        Stock_logic::add_stock( $data );

        // 改狀態為已入帳

        Purchase_logic::purchase_verify( $purchase_id_array );      

        // 3.34 sec  insert_format_use_by_upload

        $this->assertTrue(true);
    
    }

    protected function get_all_product()
    {

    	$result = DB::table("product")
    				->select(
    						"product.product_name",
    						"product_extra.product_id",
    						"product_extra.product_type",
    						"product_extra.tshirt_type",
    						"product_extra.team"
    						// "product_spec.id as spec_id"
    					)
    				->leftJoin("product_extra", 'product_extra.product_id', '=', 'product.id')
    				// ->leftJoin("product_spec", 'product_spec.product_id', '=', 'product.id')
    				->get();

    	return $result;

    }

    protected function get_all_product_assign()
    {

        $result = DB::table("product")
                    ->select(
                            "product.product_name",
                            "product_extra.product_id",
                            "product_extra.product_type",
                            "product_extra.tshirt_type",
                            "product_extra.team"
                        )
                    ->leftJoin("product_extra", 'product_extra.product_id', '=', 'product.id')
                    ->where("team", "=", "BostonCeltics")
                    ->where("tshirt_type", "=", "home")
                    ->get();

        return $result;

    }

    protected function get_all_purchase_id()
    {

    	$result = DB::table("purchase")
    				->select(
    						"id"
    					)
                    ->where("status", "=", "1")
    				->get();

    	return $result;

    }

}
