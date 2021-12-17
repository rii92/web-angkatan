<?php

namespace Database\Seeders;

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
        $roles = [
            [
                'name' => ROLE_ADMIN,
                "description" => "Role untuk admin yang punya akses ke semua halaman. Hanya dimiliki oleh anak TI"
            ],
            [
                'name' => ROLE_BPH,
                "description" => "Role untuk seluruh BPH, punya akses kesemua halaman kecuali halaman administrator"
            ],
            [
                'name' => ROLE_AKADEMIK,
                "description" => "Role untuk anak angkatan divisi akademik, khususnya untuk menu konsultasi akademik"
            ],
            [
                'name' => ROLE_HUMAS,
                "description" => "Role untuk anak angkatan divisi humas, khususnya untuk menu konsultasi umum dan sambat"
            ]
        ];

        foreach ($roles as $role) {
            $r = Role::create($role);
            $r->givePermissionTo(PERMISSION_AKSES_ADMIN);

            if ($role['name'] == ROLE_ADMIN)
                $r->givePermissionTo(PERMISSION_AKSES_ADMINISTRATOR);
        }
    }
}
