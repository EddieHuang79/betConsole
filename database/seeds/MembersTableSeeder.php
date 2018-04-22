<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('member')->truncate();
    	$faker = Faker::create('zh_TW');
    	for ($i=0; $i < 10; $i++) 
    	{ 

	        DB::table('member')->insert([
	        					'account'	=>	$faker->email,
	        					'password'	=>	bcrypt('secret'),
	        					'real_name'	=>	$faker->name,
	        					'mobile'	=>	$faker->phoneNumber,
	        					'parents_id'=>	'0',
	        					'status'	=>	'1'
	        				]);

    	}

    }
}
