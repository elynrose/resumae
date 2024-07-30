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
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'job_category_create',
            ],
            [
                'id'    => 22,
                'title' => 'job_category_edit',
            ],
            [
                'id'    => 23,
                'title' => 'job_category_show',
            ],
            [
                'id'    => 24,
                'title' => 'job_category_delete',
            ],
            [
                'id'    => 25,
                'title' => 'job_category_access',
            ],
            [
                'id'    => 26,
                'title' => 'skill_create',
            ],
            [
                'id'    => 27,
                'title' => 'skill_edit',
            ],
            [
                'id'    => 28,
                'title' => 'skill_show',
            ],
            [
                'id'    => 29,
                'title' => 'skill_delete',
            ],
            [
                'id'    => 30,
                'title' => 'skill_access',
            ],
            [
                'id'    => 31,
                'title' => 'my_resume_create',
            ],
            [
                'id'    => 32,
                'title' => 'my_resume_edit',
            ],
            [
                'id'    => 33,
                'title' => 'my_resume_show',
            ],
            [
                'id'    => 34,
                'title' => 'my_resume_delete',
            ],
            [
                'id'    => 35,
                'title' => 'my_resume_access',
            ],
            [
                'id'    => 36,
                'title' => 'request_resume_create',
            ],
            [
                'id'    => 37,
                'title' => 'request_resume_edit',
            ],
            [
                'id'    => 38,
                'title' => 'request_resume_show',
            ],
            [
                'id'    => 39,
                'title' => 'request_resume_delete',
            ],
            [
                'id'    => 40,
                'title' => 'request_resume_access',
            ],
            [
                'id'    => 41,
                'title' => 'my_skill_create',
            ],
            [
                'id'    => 42,
                'title' => 'my_skill_edit',
            ],
            [
                'id'    => 43,
                'title' => 'my_skill_show',
            ],
            [
                'id'    => 44,
                'title' => 'my_skill_delete',
            ],
            [
                'id'    => 45,
                'title' => 'my_skill_access',
            ],
            [
                'id'    => 46,
                'title' => 'job_posting_create',
            ],
            [
                'id'    => 47,
                'title' => 'job_posting_edit',
            ],
            [
                'id'    => 48,
                'title' => 'job_posting_show',
            ],
            [
                'id'    => 49,
                'title' => 'job_posting_delete',
            ],
            [
                'id'    => 50,
                'title' => 'job_posting_access',
            ],
            [
                'id'    => 51,
                'title' => 'job_skill_create',
            ],
            [
                'id'    => 52,
                'title' => 'job_skill_edit',
            ],
            [
                'id'    => 53,
                'title' => 'job_skill_show',
            ],
            [
                'id'    => 54,
                'title' => 'job_skill_delete',
            ],
            [
                'id'    => 55,
                'title' => 'job_skill_access',
            ],
            [
                'id'    => 56,
                'title' => 'payment_create',
            ],
            [
                'id'    => 57,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 58,
                'title' => 'payment_show',
            ],
            [
                'id'    => 59,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 60,
                'title' => 'payment_access',
            ],
            [
                'id'    => 61,
                'title' => 'credit_create',
            ],
            [
                'id'    => 62,
                'title' => 'credit_edit',
            ],
            [
                'id'    => 63,
                'title' => 'credit_show',
            ],
            [
                'id'    => 64,
                'title' => 'credit_delete',
            ],
            [
                'id'    => 65,
                'title' => 'credit_access',
            ],
            [
                'id'    => 66,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
