<?php

namespace Database\Seeders;

use App\Constants\AppPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission = [
            [
                'name' => AppPermissions::DASHBOARD_ACCESS,
                'description' => "Permission for access admin dashboard"
            ],
            [
                'name' => AppPermissions::ADMIN_ACCESS,
                'description' => "Permission to access administrator menu,such as manage users and roles"
            ],
            [
                'name' => AppPermissions::MEETING_MANAGEMENT,
                'description' => "Permission to access meeting management menu, to create, update, and delete new meeting"
            ],
            [
                'name' => AppPermissions::ANNOUNCEMENT_MANAGEMENT,
                'description' => "Permission to access announcement management menu, to create, update, and delete new announcement"
            ],
            [
                'name' => AppPermissions::TIMELINE_MANAGEMENT,
                'description' => "Permission to access timeline management menu, to create, update, and delete new timeline"
            ]
        ];

        foreach ($permission as $permission) {
            Permission::updateOrCreate($permission);
        }
    }
}
