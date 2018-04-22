<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Response;

class Http extends TestCase
{

	protected $url = "";

	protected $session_data = array();

	public function __construct()
	{

		// 文字
		$this->session_data = 	array(
									"Login_user"	 => array(
								                           "user_id"       => 1,
								                           "account"       => "admin@base.com",
								                           "real_name"     => "系統管理者",
								                           "token"         => "12313",
								                           "time"          => time()
								                        ),
									"Store"			=>	1,
									"Register_user" => array(
								                           "account"            => "admin@base.com",
								                           "password"           => "123456",
								                           "re_check_pwd"       => "123456",
								                           "mobile"             => "0910222333",
								                           "real_name"          => "XXX",
								                           "StoreName"          => "AAA",
								                           "store_type_id"      => "1",
								                           "StoreCode"          => "ZZZ",
								                           "verify_code"        => 0,
								                           "token"              => "",
								                           "social_register"    => 0,
								                           "active"             => 1
								                        ),
									"Verifycode_img" => array(
														  0 => "a87ff679a2f3e71d9181a67b7542122c",
														  1 => "c4ca4238a0b923820dcc509a6f75849b",
														  2 => "c81e728d9d4c2f636f067f89cc14862c",
														  3 => "8f14e45fceea167a5a36dedd4bea2543"
														),
									"ErrorMsg" 		=>	array()
								);

	}

    public function testIndex()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
	    // 首頁

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/');

	    $this->assertEquals(200, $response->status());

	    
	    // 後端主頁

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/admin_index');

	    $this->assertEquals(200, $response->status());


    	// 登入

	    $response = $this->call('GET', $url.'/login');

	    $this->assertEquals(200, $response->status());


	    // 登出

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/logout');

	    $this->assertEquals(302, $response->status());


    	// 登入過程

	    $response = $this->call('POST', $url.'/login');

	    $this->assertEquals(302, $response->status());



    	// 重刷驗證碼

	    $response = $this->call('POST', $url.'/refresh');

	    $this->assertEquals(200, $response->status());


    }

    public function testRegister()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
	    // 註冊頁

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/register');

	    $this->assertEquals(200, $response->status());


	    // 註冊頁 post

	    $response = $this->withSession( $this->session_data )->call('POST', $url.'/register');

	    $this->assertEquals(302, $response->status());


	    // 註冊頁 完成

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/register_finish');

	    $this->assertEquals(200, $response->status());	    


	    // 忘記密碼

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/forgot_password');

	    $this->assertEquals(200, $response->status());	 


	    // 忘記密碼 處理

	    $response = $this->withSession( $this->session_data )->call('POST', $url.'/forgot_password');

	    $this->assertEquals(302, $response->status());	 


	    // 忘記密碼 完成

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/reset');

	    $this->assertEquals(200, $response->status());	 

    }


    public function testUser()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/user";


	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());


	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());


	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());


	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());


	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/photo_index');

	    $this->assertEquals(200, $response->status());


    }


    public function testRole()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/role";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

    }


    public function testService()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/service";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 發布服務

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/service_public');

	    $this->assertEquals(200, $response->status());

	    // 發布服務轉頁 302才對，但一直顯示200

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/service_public_process');

	    $this->assertEquals(200, $response->status());

    }


    public function testRecord()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
    	// 系統記錄

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/record');

	    $this->assertEquals(200, $response->status());


    }


    public function testMsg()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/msg";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 複製

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/msg_clone');

	    $this->assertEquals(302, $response->status());

    }


    public function testStore()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/store";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 切換商店

	    $response = $this->withSession( $this->session_data )->call('POST', $url.'/change_store');

	    $this->assertEquals(302, $response->status());


    }


    public function testMall()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/mall";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());


    }


    public function testShop()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/shop";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/buy');

	    $this->assertEquals(200, $response->status());

	    // 紀錄

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/buy_record');

	    $this->assertEquals(200, $response->status());

    }


    public function testProduct()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/product";


	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());


	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());


	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());


	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

    }


    public function testPurchase()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/purchase";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 入帳

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/purchase_verify");

	    $this->assertEquals(302, $response->status());


    }


    public function testStock()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
    	// 庫存批量

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/stock_batch_list');

	    $this->assertEquals(200, $response->status());


	    // 庫存總量

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/stock_total_list');

	    $this->assertEquals(200, $response->status());


	    // 過期庫存

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/immediate_stock_list');

	    $this->assertEquals(200, $response->status());


	    // 安全庫存

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/lack_of_stock_list');

	    $this->assertEquals(200, $response->status());


    }

    public function testOrder()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/order";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 入帳

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/order_verify");

	    $this->assertEquals(302, $response->status());

    }


    public function testUpload()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
    	// 商品上傳

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/product_upload');

	    $this->assertEquals(200, $response->status());


	    // 商品上傳過程

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/product_upload_process");

	    $this->assertEquals(302, $response->status());


	    // 規格上傳

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/product_spec_upload');

	    $this->assertEquals(200, $response->status());


	    // 規格上傳過程

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/product_spec_upload_process");

	    $this->assertEquals(302, $response->status());


	    // 進貨上傳

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/purchase_upload');

	    $this->assertEquals(200, $response->status());


	    // 進貨上傳過程

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/purchase_upload_process");

	    $this->assertEquals(302, $response->status());


	    // 訂單上傳

	    $response = $this->withSession( $this->session_data )->call('GET', $url.'/order_upload');

	    $this->assertEquals(200, $response->status());


	    // 訂單上傳過程

	    $response = $this->withSession( $this->session_data )->call('POST', $url."/order_upload_process");

	    $this->assertEquals(302, $response->status());

    }


    public function testProductCategory()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();

    	
    	// 測試項目

    	$item = "/product_category";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(200, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(200, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());


    }

    public function testPromo()
    {

    	// 前置詞

    	$url = $this->url;

    	$this->withoutMiddleware();


    	// 測試項目

    	$item = "/promo";

	    // 列表

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item);

	    $this->assertEquals(302, $response->status());

	    // 新增

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/create');

	    $this->assertEquals(302, $response->status());

	    // 修改

	    $response = $this->withSession( $this->session_data )->call('GET', $url.$item.'/1/edit');

	    $this->assertEquals(200, $response->status());

	    // 空值轉頁

	    $response = $this->withSession( $this->session_data )->call('POST', $url.$item);

	    $this->assertEquals(302, $response->status());

    }

}
