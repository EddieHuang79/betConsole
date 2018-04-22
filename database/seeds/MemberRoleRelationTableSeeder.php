<?php

use Illuminate\Database\Seeder;

class MemberRoleRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 12; $i++)
        { 
			DB::table('member_role_relation')->insert(['member_id' => $i, 'role_id' => rand(1,4)]);           	
        }
    }
}
