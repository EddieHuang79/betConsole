<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = array(
                        array(
                            "name"          => '客戶首頁',
                            "link"          => '/index',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 1,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '儀表板',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 2,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '硬體使用率',
                            "link"          => '/machine_usage',
                            "parents_id"    => 2,
                            "status"        => 1,
                            "sort"          => 3,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '目前使用人數',
                            "link"          => '/online_person',
                            "parents_id"    => 2,
                            "status"        => 1,
                            "sort"          => 4,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '系統版本',
                            "link"          => '/sys_version',
                            "parents_id"    => 2,
                            "status"        => 1,
                            "sort"          => 5,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '設定選項',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 6,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '網路設定',
                            "link"          => '/siteopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 7,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => 'Proxy設定',
                            "link"          => '/proxyopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 8,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '時間設定',
                            "link"          => '/timeopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 9,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => 'Logo上傳',
                            "link"          => '/logoupload',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 10,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '路徑設定',
                            "link"          => '/pathopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 11,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '郵件設定',
                            "link"          => '/mailopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 12,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '限制選項',
                            "link"          => '/limitopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 13,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '安全性選項',
                            "link"          => '/safeopt',
                            "parents_id"    => 6,
                            "status"        => 1,
                            "sort"          => 14,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '記錄報表',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 15,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '記錄匯出',
                            "link"          => '/recordexport',
                            "parents_id"    => 15,
                            "status"        => 1,
                            "sort"          => 16,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '記錄寄送',
                            "link"          => '/recordmail',
                            "parents_id"    => 15,
                            "status"        => 1,
                            "sort"          => 17,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '授權',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 18,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '匯入授權檔',
                            "link"          => '/importlicence',
                            "parents_id"    => 18,
                            "status"        => 1,
                            "sort"          => 19,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '授權資訊',
                            "link"          => '/licenceinfo',
                            "parents_id"    => 18,
                            "status"        => 1,
                            "sort"          => 20,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '權限管理',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 21,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '管理員新增',
                            "link"          => '/adminadd',
                            "parents_id"    => 21,
                            "status"        => 1,
                            "sort"          => 22,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '管理員列表',
                            "link"          => '/adminlist',
                            "parents_id"    => 21,
                            "status"        => 1,
                            "sort"          => 23,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '管理員稽核',
                            "link"          => '/adminverify',
                            "parents_id"    => 21,
                            "status"        => 1,
                            "sort"          => 24,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '版本更新',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 25,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '版本資訊',
                            "link"          => '/versioninfo',
                            "parents_id"    => 25,
                            "status"        => 1,
                            "sort"          => 26,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '檢查新版本',
                            "link"          => '/updateversion',
                            "parents_id"    => 25,
                            "status"        => 1,
                            "sort"          => 27,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '備份還原',
                            "link"          => '',
                            "parents_id"    => 0,
                            "status"        => 1,
                            "sort"          => 28,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        ),
                        array(
                            "name"          => '設定檔匯出與還原',
                            "link"          => '/optbackup',
                            "parents_id"    => 28,
                            "status"        => 1,
                            "sort"          => 29,
                            "created_at"    => date("Y-m-d H:i:s"),
                            "updated_at"    => date("Y-m-d H:i:s")
                        )
                    );

        foreach ($service as $key => $value) 
        {

            DB::table('service')->insert($value);   
 
        }       

    }
}
