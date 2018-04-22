<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$role = array("店舖管理者","運營人員","物流人員","財務人員");

    	foreach ($role as $key => $value) 
    	{
	        DB::table('role')->insert([
	        					'name'		=>	$value,
	        					'status'	=>	1,
	        					'created_at'	=>	date("Y-m-d H:i:s"),
	        					'updated_at'	=>	date("Y-m-d H:i:s")
	        				]);    
    	}

    }
}
