<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleServiceRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_service = array(
                                1   =>  array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29),
                                2   =>  array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17),
                                3   =>  array(1,18,19,20,21,22,23,24),
                                4   =>  array(1,25,26,27,28,29)
                        );

        foreach ($role_service as $key => $array)
        {
            foreach ($array as $value)
            {
                DB::table('role_service_relation')->insert(['role_id'=>$key,'service_id'=>$value]);   
            }
        }   

    }
}
