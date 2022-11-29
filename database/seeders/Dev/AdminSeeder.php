<?php

namespace Database\Seeders\Dev;

use App\Constants\AppRoles;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'test@mail.com',
            'password' => Hash::make('patrickstar'),
        ]);

        $user->details()->save(new UserDetails([
            "nim" => "221810000"
        ]));

        $user->assignRole([AppRoles::ADMIN, AppRoles::USERS]);
    }
}
