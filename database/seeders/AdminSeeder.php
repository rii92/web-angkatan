<?php

namespace Database\Seeders;

use App\Constants\AppPermissions;
use App\Constants\AppRoles;
use App\Models\User;
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
            'password' => Hash::make('patrickstar')
        ]);

        $user->assignRole([AppRoles::ADMIN, AppRoles::USERS])->givePermissionTo(AppPermissions::ADMIN_ACCESS);
    }
}
