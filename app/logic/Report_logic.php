<?php

namespace App\logic;

use Illuminate\Support\Facades\Session;

class Report_logic extends Basetool
{


	protected $PromotionType1 = array(
		                            "代理人 (Affiliate)" => 1,
		                            "直客 (Direct user)" => 2,
		                            "廣告 (Advertisement)" => 3,
		                            "推薦好友" => 4
		                        );

	protected $PromotionType2 = array(
		                            1 => "代理人 (Affiliate)",
		                            2 => "直客 (Direct user)",
		                            3 => "廣告 (Advertisement)",
		                            4 => "推薦好友"
		                        );

	protected $ColumnX = array(
		                            0 => "存款金額",
		                            1 => "提款金額",
		                            2 => "轉出金額",
		                            3 => "轉入金額"
		                        );

	/*

	series: [{
	    name: 'John',
	    data: [5, 3, 4, 7, 2]
	}, {
	    name: 'Jane',
	    data: [2, 2, 3, 2, 1]
	}, {
	    name: 'Joe',
	    data: [3, 4, 4, 2, 5]
	}]

	*/

	#	X: 4種行為,Y: 人數, type: stack Column

	#	建議加入區間，以免筆數過多

	#	於每小時0分更新資料

	public static function report1()
	{

		$_this = new self();

		$PromotionType2 = $_this->PromotionType2;

		$result = array(
						"title" 		=> "總存款人數、提款人數、轉出人數和轉入人數",
						"yAxisTitle" 	=> "人數",
						"categories" 	=> array("存款人數","提款人數","轉出人數","轉入人數"),
						"series" 		=> array(),
					);

		$data = array( "DepositAmount", "WithdrawalAmount", "FundOut", "FundIn" );

		$search_deadline = mktime(date("H")+1,0,0,date("m"),date("d"),date("Y"));

		$Redis_key = 1;

		$cache_data = Redis_tool::get_report_data( $Redis_key, $search_deadline );

		if ( is_null($cache_data) || empty($cache_data) ) 
		{

			foreach ($data as $column) 
			{

				$source = API_logic::report1( $column );

				foreach ($source as $row) 
				{

					$result["series"][$row->PromotionType - 1]["name"] = isset( $PromotionType2[$row->PromotionType] ) ? $PromotionType2[$row->PromotionType] : "" ;
					$result["series"][$row->PromotionType - 1]["data"][] = $row->cnt;

				}

			}

			$result = json_encode($result);

			Redis_tool::set_report_data( $Redis_key, $result, $search_deadline );
			
		}
		else
		{

			$result = $cache_data;

		}

		return $result;

	}

	/*

	series: [{
	    name: 'John',
	    data: [5, 3, 4, 7, 2]
	}, {
	    name: 'Jane',
	    data: [2, 2, 3, 2, 1]
	}, {
	    name: 'Joe',
	    data: [3, 4, 4, 2, 5]
	}]

	*/

	# 	X: 4種會員類型,Y: 金額, type: stack Column

	#	建議加入區間，以免筆數過多

	#	於每小時5分更新資料

	public static function report2()
	{

		$_this = new self();

		$PromotionType2 = $_this->PromotionType2;

		$ColumnX = $_this->ColumnX;

		$result = array(
						"title" 		=> "總存款金額、提款金額、轉出金額和轉入金額",
						"yAxisTitle" 	=> "金額",
						"categories" 	=> array("代理人 (Affiliate)","直客 (Direct user)","廣告 (Advertisement)","推薦好友"),
						"series" 		=> array(),
					);

		$search_deadline = mktime(date("H")+1,5,0,date("m"),date("d"),date("Y"));

		$Redis_key = 2;

		$cache_data = Redis_tool::get_report_data( $Redis_key, $search_deadline );

		if ( is_null($cache_data) || empty($cache_data) ) 
		{

			$data = API_logic::report2();

			foreach ($ColumnX as $index => $ColumnName) 
			{

				$result["series"][$index]["name"] = $ColumnName ;

				foreach ($data as $row) 
				{

					switch ($index) 
					{

						case 0:
							$result["series"][$index]["data"][] = (int)$row->SumDepositAmount;
							break;

						case 1:
							$result["series"][$index]["data"][] = (int)$row->SumWithdrawalAmount;
							break;						

						case 2:
							$result["series"][$index]["data"][] = (int)$row->SumFundOut;
							break;

						case 3:
							$result["series"][$index]["data"][] = (int)$row->SumFundIn;
							break;

					}

				}

			}

			$result = json_encode($result);

			Redis_tool::set_report_data( $Redis_key, $result, $search_deadline );
			
		}
		else
		{

			$result = $cache_data;

		}

		return $result;

	}

	/*

	series: [{
	    name: 'John',
	    data: [5, 3, 4, 7, 2]
	}, {
	    name: 'Jane',
	    data: [2, 2, 3, 2, 1]
	}, {
	    name: 'Joe',
	    data: [3, 4, 4, 2, 5]
	}]

	*/

	# 	X: 日期,Y: 存款金額, type: stack Column

	#	X軸區間定義不明

	#	於每小時10分更新資料

	public static function report3()
	{

		$_this = new self();

		$PromotionType2 = $_this->PromotionType2;

		$result = array(
						"title" 		=> "存款金額變化",
						"yAxisTitle" 	=> "金額",
						"categories" 	=> array("4/1","4/2","4/3"),
						"series" 		=> array(),
					);

		$data = array( "2018-04-01", "2018-04-02", "2018-04-03" );

		$search_deadline = mktime(date("H")+1,10,0,date("m"),date("d"),date("Y"));

		$Redis_key = 3;

		$cache_data = Redis_tool::get_report_data( $Redis_key, $search_deadline );

		if ( is_null($cache_data) || empty($cache_data) ) 
		{

			foreach ($data as $date) 
			{

				$source = API_logic::report3( $date );

				foreach ($source as $row) 
				{

					$result["series"][$row->PromotionType - 1]["name"] = isset( $PromotionType2[$row->PromotionType] ) ? $PromotionType2[$row->PromotionType] : "" ;
					$result["series"][$row->PromotionType - 1]["data"][] = (int)$row->SumDepositAmount;

				}

			}

			$result = json_encode($result);

			Redis_tool::set_report_data( $Redis_key, $result, $search_deadline );
			
		}
		else
		{

			$result = $cache_data;

		}

		return $result;

	}

	/*

	series: [{
	    name: 'John',
	    data: [5, 3, 4, 7, 2]
	}, {
	    name: 'Jane',
	    data: [2, 2, 3, 2, 1]
	}, {
	    name: 'Joe',
	    data: [3, 4, 4, 2, 5]
	}]

	*/

	# 	X: 日期,Y: 提款金額, type: stack Column

	#	X軸區間定義不明

	#	於每小時15分更新資料

	public static function report4()
	{

		$_this = new self();

		$PromotionType2 = $_this->PromotionType2;

		$result = array(
						"title" 		=> "提款金額變化",
						"yAxisTitle" 	=> "金額",
						"categories" 	=> array("4/1","4/2","4/3"),
						"series" 		=> array(),
					);

		$data = array( "2018-04-01", "2018-04-02", "2018-04-03" );

		$search_deadline = mktime(date("H")+1,15,0,date("m"),date("d"),date("Y"));

		$Redis_key = 4;

		$cache_data = Redis_tool::get_report_data( $Redis_key, $search_deadline );

		if ( is_null($cache_data) || empty($cache_data) ) 
		{

			foreach ($data as $date) 
			{

				$source = API_logic::report4( $date );

				foreach ($source as $row) 
				{

					$result["series"][$row->PromotionType - 1]["name"] = isset( $PromotionType2[$row->PromotionType] ) ? $PromotionType2[$row->PromotionType] : "" ;
					$result["series"][$row->PromotionType - 1]["data"][] = (int)$row->SumWithdrawalAmount;

				}

			}

			$result = json_encode($result);

			Redis_tool::set_report_data( $Redis_key, $result, $search_deadline );
			
		}
		else
		{

			$result = $cache_data;

		}

		return $result;

	}

	/*

    series: [{
        name: 'Asia',
        data: [502, 635, 809, 947, 1402, 3634, 5268]
    }, {
        name: 'Africa',
        data: [106, 107, 111, 133, 221, 767, 1766]
    }, {
        name: 'Europe',
        data: [163, 203, 276, 408, 547, 729, 628]
    }, {
        name: 'America',
        data: [18, 31, 54, 156, 339, 818, 1201]
    }, {
        name: 'Oceania',
        data: [2, 2, 2, 6, 13, 30, 46]
    }]

	*/

	# 	X: 日期,Y: 人數

	#	X軸區間定義不明

	#	於每小時20分更新資料

	public static function report5()
	{

		$_this = new self();

		$PromotionType2 = $_this->PromotionType2;

		$result = array(
						"title" 		=> "各渠道1日留存變化",
						"subtitle" 		=> "留存=一定時間內有進行註冊/投注/存提/轉出轉入/領取紅利等行為",
						"yAxisTitle" 	=> "人數",
						"categories" 	=> array("4/2","4/3","4/4"),
						"series" 		=> array(),
					);

		$data = array( "2018-04-01", "2018-04-02", "2018-04-03" );

		$search_deadline = mktime(date("H")+1,20,0,date("m"),date("d"),date("Y"));

		$Redis_key = 5;

		$cache_data = Redis_tool::get_report_data( $Redis_key, $search_deadline );

		if ( is_null($cache_data) || empty($cache_data) ) 
		{

			foreach ($data as $date) 
			{

				$source = API_logic::report5( $date );

				foreach ($source as $PromotionType => $row) 
				{

					$result["series"][$PromotionType - 1]["name"] = isset( $PromotionType2[$PromotionType] ) ? $PromotionType2[$PromotionType] : "" ;
					$result["series"][$PromotionType - 1]["data"][] = count($row);

				}

			}

			$result = json_encode($result);

			Redis_tool::set_report_data( $Redis_key, $result, $search_deadline );
			
		}
		else
		{

			$result = $cache_data;

		}

		return $result;

	}

	/*

    series: [{
        name: 'Asia',
        data: [502, 635, 809, 947, 1402, 3634, 5268]
    }, {
        name: 'Africa',
        data: [106, 107, 111, 133, 221, 767, 1766]
    }, {
        name: 'Europe',
        data: [163, 203, 276, 408, 547, 729, 628]
    }, {
        name: 'America',
        data: [18, 31, 54, 156, 339, 818, 1201]
    }, {
        name: 'Oceania',
        data: [2, 2, 2, 6, 13, 30, 46]
    }]

	*/

	# 	X: 日期,Y: 人數

	#	X軸區間定義不明

	#	於每小時25分更新資料

	public static function report6()
	{

	}


}
