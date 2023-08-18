<?php

namespace Database\Seeders\System;

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
                'name' => AppPermissions::MAKE_KONSULTASI,
                'description' => "Permission to make a new konsultasi, either konsultasi umum or konsultasi skripsi"
            ],
            [
                'name' => AppPermissions::REPLY_KONSULTASI_AKADEMIK,
                'description' => "Permission to reply konsultasi akademik and manage it"
            ],
            [
                'name' => AppPermissions::REPLY_KONSULTASI_UMUM,
                'description' => "Permission to reply konsultasi umum and manage it"
            ],
            [
                'name' => AppPermissions::MAKE_TURNITIN,
                'description' => "Permission to make a new turnitin submissions"
            ],
            [
                'name' => AppPermissions::TURNITIN_MANAGEMENT,
                'description' => "Permission to access turnitin submission management menu, to update turnitin submission"
            ],
            [
                'name' => AppPermissions::DELETE_SAMBAT,
                'description' => "Permission to delete sambat and it's comment"
            ],
            [
                'name' => AppPermissions::TIMELINE_MANAGEMENT,
                'description' => "Permission to access timeline management menu, to create, update, and delete new timeline"
            ],
            [
                'name' => AppPermissions::SIMULATION_ACCESS,
                'description' => 'Permission to access simulations, for the better future hehe'
            ],
            [
                'name' => AppPermissions::SIMULATION_MANAGEMENT,
                'description' => 'Permission to manage simulations, for the better future hehe'
            ]
        ];

        foreach ($permission as $permission) {
            Permission::updateOrCreate($permission);
        }
    }
}
