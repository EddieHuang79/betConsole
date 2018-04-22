<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MsgModule extends Migration
{


    protected $user_table = "user";
    protected $role_table = "role";
    protected $service_table = "service";
    protected $user_role_table = "user_role_relation";
    protected $role_service_table = "role_service_relation";
    protected $service_user_table = "service_user_relation";
    protected $msg_table = "msg";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // msg 
        // show_type - 1:web,2:web popup,3:email
        // msg_type - 1:normal,2:system
        // role_id - 0:public,x:belong to which role
        // public - 0:no,1:yes
        // if show type = 2, use redis to record who read...

        Schema::create($this->msg_table, function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('subject');
            $table->string('content');
            $table->integer('role_id')->index();
            $table->integer('user_id');
            $table->integer('show_type')->default(1)->index();
            $table->integer('msg_type')->default(1)->index();
            $table->integer('public')->default(0)->index();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // service
        $msg_id = DB::table($this->service_table)->insertGetId(
            array(
                'name'          => '訊息管理',
                'link'          => '',
                'parents_id'    => 0,
                'status'        => 1,
                'public'        => 4,
                'sort'          => 15,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );
        DB::table($this->service_table)->insert(
            array(
                'name'          => '新增訊息',
                'link'          => '/msg/create',
                'parents_id'    => $msg_id,
                'status'        => 1,
                'public'        => 4,
                'sort'          => 16,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );
        DB::table($this->service_table)->insert(
            array(
                'name'          => '訊息列表',
                'link'          => '/msg',
                'parents_id'    => $msg_id,
                'status'        => 1,
                'public'        => 4,
                'sort'          => 17,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );

         // role_service
        $service_data = DB::table('service')->select('id')->where('name', 'like', '%訊息%')->get();
        foreach ($service_data as $row) 
        {
            DB::table($this->role_service_table)->insert(
                array(
                    'role_id'      => 1,
                    'service_id'   => $row->id
                )
            );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists($this->msg_table);

         // role_service
        $service_data = DB::table('service')->select('id')->where('name', 'like', '%訊息%')->get();
        foreach ($service_data as $row) 
        {
            DB::table($this->role_service_table)->where("service_id" ,"=", $row->id)->delete();
        }

        foreach ($service_data as $row) 
        {
            DB::table($this->service_table)->where("id" ,"=", $row->id)->delete();
        }

    }
}
