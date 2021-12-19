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
            ]
        ];

        foreach($permission as $permission)
        {
            Permission::create($permission);
        }
    }
}
