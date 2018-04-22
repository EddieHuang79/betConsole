<?php

namespace App\logic;

use Illuminate\Support\Facades\Session;
use Image;
use Illuminate\Support\Facades\Storage;

class Verifycode
{

	private $verifycode_length = 4;

	private $verifycode = "";

	private $verifycode_img = "";

	private function random_num( $length = 4, $min = 0, $max = 9999 )
	{
		
		$num = rand($min, $max);
		
		$result = str_pad($num, $length, "0", STR_PAD_LEFT);
		
		return $result;

	}

	private function encode_num( $num )
	{

		return md5($num);
	
	}

	private function set_rules()
	{
		
		$this->verifycode = $this->random_num( $this->verifycode_length, 0, 9999 );

	}

	private function clear_image()
	{

		$target = public_path( 'verifycodeimg' );

		$data = scandir($target);

		if ( !empty($data) && is_array($data) ) 
		{

			foreach ($data as $row) 
			{

				if ( strpos($row, ".png") ) 
				{

					unlink( $target . '/' . $row );

				}

			}

		}

	}

	private function GDImage()
	{

		$this->clear_image();

		$fileName = md5("GDIM:".time());

		$img = Image::canvas(100, 50, '#dd4b39');

		$img->text($this->verifycode, 50, 25, function($font) {
		    $font->file(5);
		    $font->size(24);
		    $font->color('#FFF');
		    $font->align('center');
		    $font->valign('center');
		    $font->angle(0);
		});

		$path = "verifycodeimg/".$fileName.".png";

		$img->save( public_path( $path ) );

		$img->destroy();

		return $path;

	}

	public function get_verify_img()
	{

		return $this->verifycode_img; 	
	
	}

	public static function auth_verify_code( $input )
	{

		$result = $input == Session::get('Verifycode') ? true : false ;

        Session::forget('Verifycode');

        Session::forget('Verifycode_img');

		return $result;

	}

	public static function get_verify_code()
	{

		$_this = new self();

		$Verifycode = Session::get('Verifycode');

		$Verifycode_img = Session::get('Verifycode_img');

		if ( !isset($Verifycode) && !isset($Verifycode_img) )
		{
	
			$_this->set_rules();

			Session::put('Verifycode', $_this->verifycode);
			
			Session::put('Verifycode_img', $_this->GDImage());
	
		}
	
	}

}

?>