<?php

namespace App\logic;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\logic\Redis_tool;

abstract class Basetool
{

    public function strFilter( $str = '' )
    {

    	$str = trim($str);
		
		$result = preg_replace("/[ '.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/", "", $str);

		return $result;

    }

    public function get_object_or_array_key( $data )
    {

    	$result = array();

        if ( !empty($data) ) 
        {

            foreach ($data as $key => $value) 
            {
            
                $result[] = intval($key);
            
            }
            
        }

    	return $result;

    }

    public function is_email( $email )
    {

       return filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    public function is_phone( $phone )
    {

        return preg_match("/^09[0-9]{8}/", $phone);
    
    }

    public function string_length( $pwd , $MinLen = 8, $MaxLen = 12)
    {

        return strlen($pwd) >= $MinLen && strlen($pwd) <= $MaxLen ;

    }

    public function pwd_complex( $pwd )
    {

        $result = preg_match("/\w{8,12}/", $pwd) && preg_match("/\d/", $pwd) && preg_match("/[a-z]/", $pwd) && preg_match("/[A-Z]/", $pwd) ? true : false;

        return $result;

    }

    public function show_error_to_user( $error )
    {

        $result = array();
            
        if ( !empty($error) && is_array($error) ) 
        {

            foreach ($error as $key => $value) 
            {
            
                $item = $key + 1;
            
                $result[]= $item . ". " . $value;
            
            }

        }

        return $result;

    }

    public function made_key( $data )
    {

        $result = implode("-", $data);

        return $result;

    }    


    // 計算欄位數

    public function ASC_Decimal_value( $count )
    {

        $result = "" ;

        if ( $count > 0 && is_int($count) ) 
        {
            
            $a = (int) floor( $count / 26 ) ;

            $b = $count % 26 ;

            $first_word = $a > 0 ? chr( 64 + $a ) : "" ;

            $second_word = chr( 64 + $b );

            $result = $first_word . $second_word;
            
        }

        return $result;

    }


    // 匯出excel

    public function export_excel( $data, $title, $final_column, $final_row, $file_name )
    {

        $result = Excel::create($file_name, function($excel) use($data,$title,$final_column,$final_row) {
            // Set the title
            $excel->setTitle($title);
            $excel->setDescription('report file');

            $excel->sheet('sheet1', function($sheet) use($data,$final_column,$final_row) {
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->setBorder('A1:'.$final_column.$final_row, 'thin');
                $sheet->cells('A1:'.$final_column.'1', function($cells) {
                    $cells->setBackground('#FFFF00');

                });
            });
        });

        return $result;
    }   


    // 查詢語句

    public function filter_search_query( $search_tool, $data )
    {

        $result = array();

        Session::put( "ListQuery", $data );

        if ( isset($data["service_id"]) && !empty($data["service_id"]) ) 
        {
        
            $result["service_id"] = intval($data["service_id"]);

        }

        if( in_array(1, $search_tool) )
        {
         
            $result["date"] = isset( $data["date"] ) && !empty( $data["date"] ) ? date( "Y-m-d", strtotime($data["date"]) ) : "" ; 
        
        }

        if( in_array(2, $search_tool) )
        {
         
            $result["account"] = isset( $data["account"] ) && !empty( $data["account"] ) ? $this->strFilter($data["account"]) : "" ; 
        
        }

        if( in_array(3, $search_tool) )
        {
         
            $result["real_name"] = isset( $data["real_name"] ) && !empty( $data["real_name"] ) ? $this->strFilter($data["real_name"]) : "" ; 
        
        }

        if( in_array(4, $search_tool) )
        {
         
            $result["role_id"] = isset( $data["role_id"] ) && !empty( $data["role_id"] ) ? intval($data["role_id"]) : 0 ; 
        
        }

        if( in_array(5, $search_tool) )
        {
         
            $result["status"] = isset( $data["status"] ) && !empty( $data["status"] ) ? intval($data["status"]) : "" ; 
        
        }

        if( in_array(6, $search_tool) )
        {
         
            $result["role_name"] = isset( $data["role_name"] ) && !empty( $data["role_name"] ) ? $this->strFilter($data["role_name"]) : "" ; 
        
        }

        if( in_array(7, $search_tool) )
        {
         
            $result["service_name"] = isset( $data["service_name"] ) && !empty( $data["service_name"] ) ? $this->strFilter($data["service_name"]) : "" ; 
        
        }

        if( in_array(8, $search_tool) )
        {
         
            $result["product_name"] = isset( $data["product_name"] ) && !empty( $data["product_name"] ) ? $this->strFilter($data["product_name"]) : "" ; 
            // $result["product_name"] = isset( $data["product_name"] ) && !empty( $data["product_name"] ) ? array_filter($data["product_name"], "trim") : "" ; 
        
        }

        if( in_array(9, $search_tool) )
        {
         
            $result["team"] = isset( $data["team"] ) && is_numeric( $data["team"] ) ? intval($data["team"]) : "" ; 
        
        }

        if( in_array(10, $search_tool) )
        {
         
            $result["tshirt_type"] = isset( $data["tshirt_type"] ) && is_numeric( $data["tshirt_type"] ) ? intval($data["tshirt_type"]) : "" ; 
        
        }

        if( in_array(15, $search_tool) )
        {
         
            $result["start_date"] = isset( $data["start_date"] ) && !empty( $data["start_date"] ) ? date( "Y-m-d", strtotime($data["start_date"]) ) : "" ; 
            $result["end_date"] = isset( $data["end_date"] ) && !empty( $data["end_date"] ) ? date( "Y-m-d", strtotime($data["end_date"]) ) : "" ; 
        
        }

        if( in_array(20, $search_tool) )
        {
         
            $result["order_number"] = isset( $data["order_number"] ) && !empty( $data["order_number"] ) ? $this->strFilter($data["order_number"]) : "" ; 
        
        }

        if( in_array(21, $search_tool) )
        {
         
            $result["buyer_name"] = isset( $data["buyer_name"] ) && !empty( $data["buyer_name"] ) ? $this->strFilter($data["buyer_name"]) : "" ; 
        
        }

        if( in_array(22, $search_tool) )
        {
         
            $result["buyer_phone"] = isset( $data["buyer_phone"] ) && !empty( $data["buyer_phone"] ) ? $this->strFilter($data["buyer_phone"]) : "" ; 
        
        }

        if( in_array(23, $search_tool) )
        {
         
            $result["status"] = isset( $data["status"] ) && !empty( $data["status"] ) ? intval($data["status"]) : "" ; 
        
        }

        if( in_array(24, $search_tool) )
        {
         
            $result["product_pos_key"] = isset( $data["product_pos_key"] ) && !empty( $data["product_pos_key"] ) ? array_filter( $data["product_pos_key"], "trim" ) : array() ; 
        
        }

        return $result;

    }   


    // 產生連結，暫不處理陣列式搜尋工具

    public function made_search_query()
    {

        $data = array();

        $ListQuery = Session::get("ListQuery");

        if ( !empty($ListQuery) && is_array($ListQuery) ) 
        {

            foreach ($ListQuery as $key => $value) 
            {

                if ( !is_array($value) ) 
                {

                    $data[] = $key . "=". $value;

                }

            }

        }

        $result = "?".implode("&", $data);

        return $result;

    }


    // 取得搜尋語句

    public function get_search_query( $search_tool, $data )
    {

        $service_id = Session::get('service_id') ? intval(Session::get('service_id')) : 0 ;

        $service_id = isset($_GET["service_id"]) ? intval($_GET["service_id"]) : $service_id ;

        Session::put('service_id', $service_id);

        $result = array();

        if ( !empty($search_tool) && !empty($data) && is_array($search_tool) && is_array($data) ) 
        {

            $result = $this->filter_search_query( $search_tool, $data );

            Redis_tool::set_search_tool( $search_tool, (int)$service_id );

        }

        return $result;

    }

    // 亂數

    public function rand( $length = 0 )
    {

        $result = "";

        $randSeed = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9");

        if ( !empty($length) && is_int($length) ) 
        {

            for ($i=0; $i < $length; $i++) 
            { 

                $randIndex = mt_rand(0, count($randSeed) - 1);

                $result .= $randSeed[$randIndex];

            }
            
        }

        return $result;

    }


}