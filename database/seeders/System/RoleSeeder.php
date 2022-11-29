<?php

namespace Database\Seeders\System;

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
        $role = Role::updateOrCreate([
            'name' => AppRoles::USERS,
            'description' => "Role for all users"
        ]);
        $role->givePermissionTo(AppPermissions::MAKE_KONSULTASI);
        $role->givePermissionTo(AppPermissions::MAKE_TURNITIN);

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
            ],
            [
                'name' => AppRoles::KOOR,
                "description" => "Role untuk anak angkatan yang jadi koor, khususnya untuk menu konsultasi umum dan sambat"
            ],
            [
                'name' => AppRoles::EO,
                "description" => "Role untuk anak angkatan divisi EO, khususnya untuk menu konsultasi umum dan sambat"
            ],
            [
                'name' => AppRoles::DANUS,
                "description" => "Role untuk anak angkatan divisi danus, khususnya untuk menu konsultasi umum dan sambat"
            ],
            [
                'name' => AppRoles::PUBDOK,
                "description" => "Role untuk anak angkatan divisi pubdok, khususnya untuk menu konsultasi umum dan sambat"
            ],
        ];

        foreach ($roles as $role) {
            $newRole = Role::updateOrCreate($role);
            $role['name'] == AppRoles::ADMIN ? $newRole->givePermissionTo(array_keys(AppPermissions::allPermissions())) :
                $newRole->givePermissionTo(AppPermissions::DASHBOARD_ACCESS);

            if ($role['name'] == AppRoles::AKADEMIK) $newRole->givePermissionTo(AppPermissions::REPLY_KONSULTASI_AKADEMIK);
            if ($role['name'] == AppRoles::HUMAS) $newRole->givePermissionTo([
                AppPermissions::REPLY_KONSULTASI_UMUM,
                AppPermissions::DELETE_SAMBAT
            ]);

            if ($role['name'] == AppRoles::BPH) $newRole->givePermissionTo([
                AppPermissions::ANNOUNCEMENT_MANAGEMENT,
                AppPermissions::MEETING_MANAGEMENT,
                AppPermissions::TURNITIN_MANAGEMENT,
                AppPermissions::SIMULATION_MANAGEMENT
            ]);

            if (($role['name'] == AppRoles::BPH) || ($role['name'] == AppRoles::KOOR))
                $newRole->givePermissionTo([
                    AppPermissions::DASHBOARD_ACCESS,
                    AppPermissions::REPLY_KONSULTASI_UMUM,
                    AppPermissions::REPLY_KONSULTASI_AKADEMIK,
                    AppPermissions::DELETE_SAMBAT
                ]);
        }

        // don't have acccess to admin menu
        $roles = [
            [
                'name' => AppRoles::MEMBER,
                "description" => "Role untuk seluruh anak angkatan"
            ],
            [
                'name' => AppRoles::ALUMNI,
                "description" => "Role untuk anak D3 angkatan 60 yang sudah lulus, mereka hanya bisa sambat tidak bisa konsultasi"
            ],
            [
                'name' => AppRoles::D3_61,
                "description" => "Role untuk anak D3 angkatan 61, mereka hanya bisa update informasi skripsi aja"
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
