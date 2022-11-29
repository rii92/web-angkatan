<?php

namespace Database\Seeders\Dev;

use App\Constants\AppRoles;
use App\Models\User;
use App\Models\UserDetails;
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
        User::factory()->count(50)->has(UserDetails::factory(), 'details')->create()->each(function (User $user) {
            $user->assignRole(AppRoles::USERS);
        });
    }
}
