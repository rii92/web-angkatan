<?php

namespace Database\Seeders;

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
        Permission::create([
            'name' => PERMISSION_AKSES_ADMIN,
            'description' => "Permission untuk akses /admin"
        ]);

        Permission::create([
            'name' => PERMISSION_AKSES_ADMINISTRATOR,
            'description' => "Permission untuk akses menu administrator (users dan roles)"
        ]);
    }
}
