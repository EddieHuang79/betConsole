<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class InitialBaseSite extends Migration
{

    protected $user_table = "user";
    protected $store_table = "store";
    protected $option_table = "option";
    protected $role_table = "role";
    protected $service_table = "service";
    protected $user_role_table = "user_role_relation";
    protected $role_service_table = "role_service_relation";
    protected $service_user_table = "service_user_relation";
    protected $invite_record = "invite_record";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // 建立初始table

        // user

        Schema::create($this->user_table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique();
            $table->string('password');
            $table->string('real_name');
            $table->string('mobile');
            $table->string('photo')->default('');
            $table->integer('parents_id')->default(0);
            $table->integer('status')->index();
            $table->integer('is_free')->default(1);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // option type - 1 store_type,99: free_use_for_key_value

        Schema::create($this->option_table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('parents_id');
            $table->integer('status');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        // role

        Schema::create($this->role_table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status')->index();
            $table->timestamps();
        });

        // service

        Schema::create($this->service_table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->integer('parents_id');
            $table->integer('status')->index();
            $table->integer('public')->default(2);
            $table->integer('sort');
            $table->timestamps();
        });

        // user_role

        Schema::create($this->user_role_table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        Schema::table($this->user_role_table, function($table) {
           $table->foreign('user_id')->references('id')->on('user');
           $table->foreign('role_id')->references('id')->on('role');
        });

        // role_service

        Schema::create($this->role_service_table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('service_id')->unsigned();
        });

        Schema::table($this->role_service_table, function($table) {
           $table->foreign('role_id')->references('id')->on('role');
           $table->foreign('service_id')->references('id')->on('service');
        });

        // service_user

        Schema::create($this->service_user_table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        Schema::table($this->service_user_table, function($table) {
           $table->foreign('service_id')->references('id')->on('service');
           $table->foreign('user_id')->references('id')->on('user');
        });


        // 寫入基本資料

        // user
        DB::table($this->user_table)->insert(
            array(
                'account'       => 'admin@base.com',
                'password'      => Hash::make('123456'),
                'real_name'     => '系統管理員',
                'mobile'        => '0900123456',
                'parents_id'    => 0,
                'status'        => 1,
                'is_free'       => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );

        // role
        DB::table($this->role_table)->insert(
            array(
                'name'          => '管理者',
                'status'        => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );

        // service
        DB::table($this->service_table)->insert(
            array(
                'name'          => '首頁',
                'link'          => '/admin_index',
                'parents_id'    => 0,
                'status'        => 1,
                'public'        => 4,
                'sort'          => 1,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );

        $sub_admin_service_id = array(1);


        $user_service_id = DB::table($this->service_table)->insertGetId(
                                array(
                                    'name'          => '使用者管理',
                                    'link'          => '',
                                    'parents_id'    => 0,
                                    'status'        => 1,
                                    'public'        => 4,
                                    'sort'          => 2,
                                    'created_at'    => date("Y-m-d H:i:s"),
                                    'updated_at'    => date("Y-m-d H:i:s")
                                )
                            );
        $sub_admin_service_id[] = $user_service_id;
        $sub_admin_service_id[] = DB::table($this->service_table)->insertGetId(
                                array(
                                    'name'          => '使用者新增',
                                    'link'          => '/user/create',
                                    'parents_id'    => $user_service_id,
                                    'status'        => 1,
                                    'public'        => 4,
                                    'sort'          => 3,
                                    'created_at'    => date("Y-m-d H:i:s"),
                                    'updated_at'    => date("Y-m-d H:i:s")
                                )
                            );
        $sub_admin_service_id[] = DB::table($this->service_table)->insertGetId(
                                    array(
                                        'name'          => '使用者列表',
                                        'link'          => '/user',
                                        'parents_id'    => $user_service_id,
                                        'status'        => 1,
                                        'public'        => 4,
                                        'sort'          => 4,
                                        'created_at'    => date("Y-m-d H:i:s"),
                                        'updated_at'    => date("Y-m-d H:i:s")
                                    )
                                );
        $sub_admin_service_id[] = DB::table($this->service_table)->insertGetId(
                                    array(
                                        'name'          => '照片上傳',
                                        'link'          => '/photo',
                                        'parents_id'    => $user_service_id,
                                        'status'        => 1,
                                        'public'        => 4,
                                        'sort'          => 11,
                                        'created_at'    => date("Y-m-d H:i:s"),
                                        'updated_at'    => date("Y-m-d H:i:s")
                                    )
                                );
        $role_service_id = DB::table($this->service_table)->insertGetId(
                                array(
                                    'name'          => '角色管理',
                                    'link'          => '',
                                    'parents_id'    => 0,
                                    'status'        => 1,
                                    'public'        => 3,
                                    'sort'          => 5,
                                    'created_at'    => date("Y-m-d H:i:s"),
                                    'updated_at'    => date("Y-m-d H:i:s")
                                )
                            );
        DB::table($this->service_table)->insertGetId(
            array(
                'name'          => '角色新增',
                'link'          => '/role/create',
                'parents_id'    => $role_service_id,
                'status'        => 1,
                'public'        => 3,
                'sort'          => 6,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );
        DB::table($this->service_table)->insertGetId(
            array(
                'name'          => '角色列表',
                'link'          => '/role',
                'parents_id'    => $role_service_id,
                'status'        => 1,
                'public'        => 3,
                'sort'          => 7,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );
        $service_id = DB::table($this->service_table)->insertGetId(
                            array(
                                'name'          => '服務管理',
                                'link'          => '',
                                'parents_id'    => 0,
                                'status'        => 1,
                                'public'        => 3,
                                'sort'          => 8,
                                'created_at'    => date("Y-m-d H:i:s"),
                                'updated_at'    => date("Y-m-d H:i:s")
                            )
                        );
        DB::table($this->service_table)->insertGetId(
            array(
                'name'          => '服務新增',
                'link'          => '/service/create',
                'parents_id'    => $service_id,
                'status'        => 1,
                'public'        => 3,
                'sort'          => 9,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );
        DB::table($this->service_table)->insertGetId(
            array(
                'name'          => '服務列表',
                'link'          => '/service',
                'parents_id'    => $service_id,
                'status'        => 1,
                'public'        => 3,
                'sort'          => 10,
                'created_at'    => date("Y-m-d H:i:s"),
                'updated_at'    => date("Y-m-d H:i:s")
            )
        );

        // user_role
        DB::table($this->user_role_table)->insert(
            array(
                'user_id'      => 1,
                'role_id'      => 1
            )
        );

        // role_service
        for ($i=1; $i < 12; $i++) 
        { 
            DB::table($this->role_service_table)->insert(
                array(
                    'role_id'      => 1,
                    'service_id'   => $i
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

        // delete redis all key

        $match_key = Redis::KEYS( "*" );

        foreach ($match_key as $row)
        {

            Redis::del( $row );

        }

        Schema::dropIfExists($this->user_role_table);
        Schema::dropIfExists($this->role_service_table);
        Schema::dropIfExists($this->service_user_table);
        Schema::dropIfExists($this->user_table);
        Schema::dropIfExists($this->option_table);
        Schema::dropIfExists($this->role_table);
        Schema::dropIfExists($this->service_table);
        
    }
}
