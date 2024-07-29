<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'job_category_create',
            ],
            [
                'id'    => 18,
                'title' => 'job_category_edit',
            ],
            [
                'id'    => 19,
                'title' => 'job_category_show',
            ],
            [
                'id'    => 20,
                'title' => 'job_category_delete',
            ],
            [
                'id'    => 21,
                'title' => 'job_category_access',
            ],
            [
                'id'    => 22,
                'title' => 'skill_create',
            ],
            [
                'id'    => 23,
                'title' => 'skill_edit',
            ],
            [
                'id'    => 24,
                'title' => 'skill_show',
            ],
            [
                'id'    => 25,
                'title' => 'skill_delete',
            ],
            [
                'id'    => 26,
                'title' => 'skill_access',
            ],
            [
                'id'    => 27,
                'title' => 'request_resume_create',
            ],
            [
                'id'    => 28,
                'title' => 'request_resume_edit',
            ],
            [
                'id'    => 29,
                'title' => 'request_resume_show',
            ],
            [
                'id'    => 30,
                'title' => 'request_resume_delete',
            ],
            [
                'id'    => 31,
                'title' => 'request_resume_access',
            ],
            [
                'id'    => 32,
                'title' => 'my_resume_create',
            ],
            [
                'id'    => 33,
                'title' => 'my_resume_edit',
            ],
            [
                'id'    => 34,
                'title' => 'my_resume_show',
            ],
            [
                'id'    => 35,
                'title' => 'my_resume_delete',
            ],
            [
                'id'    => 36,
                'title' => 'my_resume_access',
            ],
            [
                'id'    => 37,
                'title' => 'my_skill_create',
            ],
            [
                'id'    => 38,
                'title' => 'my_skill_edit',
            ],
            [
                'id'    => 39,
                'title' => 'my_skill_show',
            ],
            [
                'id'    => 40,
                'title' => 'my_skill_delete',
            ],
            [
                'id'    => 41,
                'title' => 'my_skill_access',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 44,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 45,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 46,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
