<?php

namespace Database\Seeders;

use App\Constants\AppRoles;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserNotification;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // mahasiswa lainnya
        User::factory()->count(400)->has(UserDetails::factory(), 'details')->create()->each(function (User $user) {
            $user->assignRole(AppRoles::USERS);
        });
    }
}
