<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->count(50)->create();
        User::factory()->count(6)->create()->each(function ($user) {
            $user->assignRole(ROLE_BPH);
        });
        User::factory()->count(12)->create()->each(function ($user) {
            $user->assignRole(ROLE_AKADEMIK);
        });
        User::factory()->count(7)->create()->each(function ($user) {
            $user->assignRole(ROLE_HUMAS);
        });
    }
}
