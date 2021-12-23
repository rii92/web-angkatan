<?php

namespace Database\Seeders;

use App\Constants\AppPermissions;
use App\Constants\AppRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'name' => AppRoles::USERS,
            'description' => "Role for all users"
        ]);

        $roles = [
            [
                'name' => AppRoles::ADMIN,
                "description" => "Role untuk admin yang punya akses ke semua halaman. Hanya dimiliki oleh anak TI"
            ],
            [
                'name' => AppRoles::BPH,
                "description" => "Role untuk seluruh BPH, punya akses kesemua halaman kecuali halaman administrator"
            ],
            [
                'name' => AppRoles::AKADEMIK,
                "description" => "Role untuk anak angkatan divisi akademik, khususnya untuk menu konsultasi akademik"
            ],
            [
                'name' => AppRoles::HUMAS,
                "description" => "Role untuk anak angkatan divisi humas, khususnya untuk menu konsultasi umum dan sambat"
            ]
        ];

        foreach ($roles as $role) {
            $newRole = Role::updateOrCreate($role);
            $role['name'] == AppRoles::ADMIN ? $newRole->givePermissionTo(array_keys(AppPermissions::allPermissions())) :
                $newRole->givePermissionTo(AppPermissions::DASHBOARD_ACCESS);
        }

        Role::updateOrCreate([
            'name' => AppRoles::MEMBER,
            'description' => "Role for all pa members"
        ]);
    }
}
