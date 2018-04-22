<?php

namespace App\logic;

use App\model\Msg;
use App\logic\Redis_tool;
use Illuminate\Support\Facades\Session;
use App\logic\Role_logic;
use App\logic\Web_cht;

class Msg_logic extends Basetool
{

	protected $role_data;
	protected $msg_type;
	protected $show_type;
	protected $txt;

	public function __construct()
	{

		// 文字
		$this->txt = Web_cht::get_txt();

		// 角色
		$this->role_data = Role_logic::get_role_array();
	
		// 訊息種類
		$this->msg_type = array(
								1 => $this->txt["normal_msg"],
								2 => $this->txt["system_msg"]
							);

		// 顯示管道
		$this->show_type = array(
								1 => $this->txt["msg_icon"],
								2 => $this->txt["popup"],
								// 3 => $this->txt["mail"]
							);

	}


	// 新增格式

	public static function insert_format( $data )
	{

		$_this = new self();

		$result = array();

		if ( !empty($data) && is_array($data) ) 
		{

			$result = array(
			            "subject"          	=> isset($data["subject"]) ? $_this->strFilter($data["subject"]) : "",
			            "content"          	=> isset($data["content"]) ? $_this->strFilter($data["content"]) : "",
			            "role_id"          	=> isset($data["role_id"]) ? intval($data["role_id"]) : "",
			            "show_type"        	=> isset($data["show_type"]) ? intval($data["show_type"]) : "",
			            "msg_type"         	=> isset($data["msg_type"]) ? intval($data["msg_type"]) : "",
			            "public"        	=> isset($data["public"]) ? intval($data["public"]) : 0,
			            "start_date"        => isset($data["start_date"]) ? date("Y-m-d H:i:00", strtotime($data["start_date"])) : "",
			            "end_date"          => isset($data["end_date"]) ? date("Y-m-d H:i:00", strtotime($data["end_date"])) : "",
			            "created_at"    	=> date("Y-m-d H:i:s"),
			            "updated_at"    	=> date("Y-m-d H:i:s")
			         );

		}

		return $result;

	}


	// 更新格式

	public static function update_format( $data )
	{

		$_this = new self();

		$result = array();

		if ( !empty($data) && is_array($data) ) 
		{

			$result = array(
			            "subject"          	=> isset($data["subject"]) ? $_this->strFilter($data["subject"]) : "",
			            "content"          	=> isset($data["content"]) ? $_this->strFilter($data["content"]) : "",
			            "role_id"          	=> isset($data["role_id"]) ? intval($data["role_id"]) : "",
			            "show_type"        	=> isset($data["show_type"]) ? intval($data["show_type"]) : "",
			            "msg_type"         	=> isset($data["msg_type"]) ? intval($data["msg_type"]) : "",
			            "public"        	=> isset($data["public"]) ? intval($data["public"]) : 0,
			            "start_date"        => isset($data["start_date"]) ? date("Y-m-d H:i:00", strtotime($data["start_date"])) : "",
			            "end_date"          => isset($data["end_date"]) ? date("Y-m-d H:i:00", strtotime($data["end_date"])) : "",
			            "updated_at"    	=> date("Y-m-d H:i:s")
			         );
		}

		return $result;

	}


	// 取得訊息

	public static function get_msg( $role_id = array(), $show_type = array(), $msg_type = array() )
	{

		$Login_user = Session::get('Login_user');

		return Msg::get_msg( $role_id, $show_type, $msg_type, array($Login_user["user_id"]) );

	}	


	// 轉換時間顯示

	public static function time_format( $data )
	{

		$result = new \stdClass;

		if ( !empty($data) ) 
		{

			foreach ($data as &$row) 
			{

				if ( is_object($row) ) 
				{

					$diff = time() - strtotime($row->updated_at);
					$show_data = ($diff / ( 60 * 60 * 24 )) > 0 ? floor($diff / ( 60 * 60 * 24 * 7 )) . " weeks" : "";
					$show_data = ($diff / ( 60 * 60 * 24 )) > 0 ? floor($diff / ( 60 * 60 * 24 )) . " days" : $show_data;
					$show_data = empty($show_data) && ($diff / ( 60 * 60 )) > 0 ? floor($diff / ( 60 * 60 )) . " hours" : $show_data ;
					$show_data = empty($show_data) && $diff / 60 > 0 ? floor($diff / 60) . " mins" : $show_data ;
					$show_data = empty($show_data) ? $diff . " secs" : $show_data ;

					$row->updated_at = $show_data;

				}

			}

			$result = $data;

		} 

		return $result;

	}	


	// 顯示未讀的第一筆 

	public static function show_popup_msg( $data )
	{

		$result = array();

		$Login_user = Session::get('Login_user');

		$read_msg = Redis_tool::get_read_msg( $Login_user["user_id"] );

		$result = array();

		$msg_id = 0;

		if ( !empty($data) ) 
		{

			foreach ($data as $row) 
			{

				if ( is_object($row) && !in_array($row->id, $read_msg) ) 
				{

					$result["subject"] = $row->subject;
					$result["content"] = $row->content;
					$msg_id = $row->id;
					break;

				}

			}

		}

		// add redis
		if (!empty($msg_id)) 
		{

			Redis_tool::set_read_msg( $Login_user["user_id"], $msg_id );

		}

		return $result;

	}	


	// 訊息列表

	public static function get_msg_list( $data )
	{

		$_this = new self();

		$txt = $_this->txt;
		$show_type = $_this->show_type;
		$msg_type = $_this->msg_type;
		$role_data = $_this->role_data;

		$result = new \stdClass;

		$option = array(
						"type" => isset($data['type']) ? intval($data['type']) : 0 
					);

		// 訊息
		$msg = Msg::get_all_msg( $option );

		if ( !empty($msg) ) 
		{

			foreach ($msg as &$row) 
			{

				if ( is_object($row) ) 
				{

					$row->role_id = isset($role_data[$row->role_id]) ? $role_data[$row->role_id] : $txt["all_role"] ; 
					$row->public_txt = $row->public === 1 ? $txt["yes"] : $txt["no"] ;
					$row->show_type = isset($show_type[$row->show_type]) ? $show_type[$row->show_type] : "" ;
					$row->msg_type = isset($msg_type[$row->msg_type]) ? $msg_type[$row->msg_type] : "" ;

				}

			}

			$result = $msg;

		}

		return $result;

	}


	// 取得選項

	public static function get_msg_option()
	{

		$_this = new self();

		$result = array(
						"msg_type" 	=> $_this->msg_type,
						"role_data" => $_this->role_data,
						"show_type" => $_this->show_type
					);

		return $result;

	}


	// 取得訊息

	public static function get_single_msg( $msg_id )
	{

		$result = new \stdClass;

		if ( !empty($msg_id) && is_int($msg_id) ) 
		{

			$data = Msg::get_single_msg( $msg_id );

			if ( is_object($data) ) 
			{

				$data->start_date = date("Y-m-d H:i:00", strtotime($data->start_date));

				$data->end_date = date("Y-m-d H:i:00", strtotime($data->end_date));

			}

			$result = $data;

		}

		return $result;

	}	


	// 修改訊息

	public static function edit_msg( $data, $msg_id )
	{

		$result = false;

		if ( !empty($data) && is_array($data) && !empty($msg_id) && is_int($msg_id) ) 
		{

			Msg::edit_msg( $data, $msg_id );

			$result = true;

		}

		return $result;

	}


	// 新增訊息

	public static function add_msg( $data )
	{

		$result = false;

		if ( !empty($data) ) 
		{

			Msg::add_msg( $data );

			$result = true;

		}

		return $result;

	}


	// 複製訊息

	public static function clone_msg( $data )
	{

		$result = array();

		if ( !empty($data) && is_object($data) && isset($data->subject) ) 
		{

			$result = array(
							"subject" 		=> $data->subject . "_[clone from id:".$data->id."]",
							"content" 		=> $data->content,
							"role_id" 		=> $data->role_id,
							"show_type" 	=> $data->show_type,
							"msg_type" 		=> $data->msg_type,
							"public" 		=> 0,
							"start_date" 	=> $data->start_date,
							"end_date" 		=> $data->end_date,
							"created_at" 	=> date("Y-m-d H:i:s"),
							"updated_at" 	=> date("Y-m-d H:i:s"),
						);

		}

		return $result;

	}


	// 新增一般訊息

	public static function add_normal_msg( $subject, $content, $user_id = 0, $show_type = 1  )
	{

		$result = false;

		if ( !empty($subject) && !empty($content) ) 
		{

			$data = array(
							"subject" 		=> $subject,
							"content" 		=> $content,
							"role_id" 		=> 0,
							"user_id" 		=> $user_id,
							"show_type" 	=> $show_type,
							"msg_type" 		=> 1,
							"public" 		=> 1,
							"start_date" 	=> date("Y-m-d H:i:s"),
							"end_date" 		=> date("Y-m-d 23:59:59"),
							"created_at" 	=> date("Y-m-d H:i:s"),
							"updated_at" 	=> date("Y-m-d H:i:s"),
						);

			Msg::add_msg( $data );

			$result = true;

		}

		return $result;

	}


	// 新增系統訊息

	public static function add_notice_msg( $subject, $content, $user_id = 0, $show_type = 1 )
	{

		$result = false;

		if ( !empty($subject) && !empty($content) ) 
		{

			$data = array(
							"subject" 		=> $subject,
							"content" 		=> $content,
							"role_id" 		=> 0,
							"user_id" 		=> $user_id,
							"show_type" 	=> $show_type,
							"msg_type" 		=> 2,
							"public" 		=> 1,
							"start_date" 	=> date("Y-m-d H:i:s"),
							"end_date" 		=> date("Y-m-d 23:59:59"),
							"created_at" 	=> date("Y-m-d H:i:s"),
							"updated_at" 	=> date("Y-m-d H:i:s"),
						);

			Msg::add_msg( $data );

			$result = true;

		}

		return $result;

	}


	// 組合列表資料

	public static function msg_list_data_bind( $OriData )
	{

		$_this = new self();

		$txt = Web_cht::get_txt();

		$result = array(
                        "title" => array(
                        				$txt['id'],
                        				$txt['subject'],
                        				$txt['content'],
                        				$txt['notice_role'],
                        				$txt['show_type'],
                        				$txt['msg_type'],
                        				$txt['is_public'],
                        				$txt['start_date'],
                        				$txt['end_date'],
                        				$txt['create_time'],
                        				$txt['update_time'],
                        				$txt['action']
                        			),
                        "data" => array()
                    );

		if ( !empty($OriData) && $OriData->isNotEmpty() ) 
		{

			foreach ($OriData as $row) 
			{
	
				if ( is_object($row) ) 
				{

					$data = array(
								"data" => array(
												"id" 					=> $row->id,
												"subject" 				=> $row->subject,
												"content" 				=> $row->content,
												"notice_role" 			=> $row->role_id,
												"show_type" 			=> $row->show_type,
												"msg_type" 				=> $row->msg_type,
												"is_public" 			=> $row->public_txt,
												"start_date" 			=> $row->start_date,
												"end_date" 				=> $row->end_date,
												"create_time" 			=> $row->created_at,
												"update_time" 			=> $row->updated_at
											),
								"Editlink" 	=> $row->public !== 1 ? "/msg/" . $row->id . "/edit?'" : "" ,
								"Clonelink" => "/msg_clone?msg_id=" . $row->id
							);

				}

				$result["data"][] = $data;
			
			}


		}

		return $result;

	}


	// 取得輸入邏輯陣列

	public static function get_msg_input_template_array()
	{

		$_this = new self();

		$txt = Web_cht::get_txt();

		$msg_option = $_this->get_msg_option(); 

		$htmlData = array(
					"subject" => array(
						"type"          => 1, 
						"title"         => $txt["subject"],
						"key"           => "subject",
						"value"         => "" ,
						"display"       => true,
						"desc"          => "",
						"attrClass"     => "",
						"hasPlugin"     => "",
						"placeholder"   => ""
					),
					"content" => array(
						"type"          => 1, 
						"title"         => $txt["content"],
						"key"           => "content",
						"value"         => "",
						"display"       => true,
						"desc"          => "",
						"attrClass"     => "",
						"hasPlugin"     => "",
						"placeholder"   => ""
					),
					"notice_role" => array(
						"type"          => 2, 
						"title"         => $txt["notice_role"],
						"key"           => "role_id",
						"value"         => "",
						"data"          => $msg_option["role_data"],
						"display"       => true,
						"desc"          => "",
						"EventFunc"     => "",
						"attrClass"     => "",
						"hasPlugin"     => "",
						"placeholder"   => "",
						"required"      => false
					),
					"show_type" => array(
						"type"          => 2, 
						"title"         => $txt["show_type"],
						"key"           => "show_type",
						"value"         => "",
						"data"          => $msg_option["show_type"],
						"display"       => true,
						"desc"          => "",
						"EventFunc"     => "",
						"attrClass"     => "",
						"hasPlugin"     => "",
						"placeholder"   => ""
					),
					"msg_type" => array(
						"type"          => 2, 
						"title"         => $txt["msg_type"],
						"key"           => "msg_type",
						"value"         => "",
						"data"          => $msg_option["msg_type"],
						"display"       => true,
						"desc"          => "",
						"attrClass"     => "",
						"hasPlugin"     => ""
					),
					"status" => array(
						"type"          => 3,
						"title"         => $txt["status"],
						"key"           => "public",
						"value"         => "",
						"data"         	=> array(
												1 => $txt["yes"],
												2 => $txt["no"]
											),
						"display"       => true,
						"desc"          => "",
						"attrClass"     => "",
						"hasPlugin"     => ""
					),
                    "start_date" => array(
                        "type"          => 1, 
                        "title"         => $txt["notice_range"] . "-" . $txt["start_date"],
                        "key"           => "start_date",
                        "value"         => "",
                        "display"       => true,
                        "attrClass"     => "",
                        "hasPlugin"     => "DateTimePicker"
                    ),
                    "end_date" => array(
                        "type"          => 1, 
                        "title"         => $txt["notice_range"] . "-" . $txt["end_date"],
                        "key"           => "end_date",
                        "value"         => "",
                        "display"       => true,
                        "attrClass"     => "",
                        "hasPlugin"     => "DateTimePicker"
                    )
		         );

		return $htmlData;

	}


	// 組合資料

	public static function msg_input_data_bind( $htmlData, $OriData )
	{

		$_this = new self();

		$result = $htmlData;

		if ( !empty($OriData) && is_array($OriData) ) 
		{

			foreach ($htmlData as &$row) 
			{

				if ( is_array($row) ) 
				{

				   $row["value"] = isset($OriData[$row["key"]]) ? $OriData[$row["key"]] : "" ;
				   
				}

			}

			$htmlData["notice_role"]["value"] = !empty($OriData["notice_role"]) ? $OriData["notice_role"] : "" ;

			$htmlData["notice_role"]["show_type"] = !empty($OriData["show_type"]) ? $OriData["show_type"] : "" ;

			$htmlData["notice_role"]["msg_type"] = !empty($OriData["msg_type"]) ? $OriData["msg_type"] : "" ;

		}

		return $htmlData;

	}

}
