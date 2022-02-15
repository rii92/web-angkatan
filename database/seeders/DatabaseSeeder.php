<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            AnonimNameSeeder::class, // it must remove after releases.
        ]);

        if (App::environment(['local', 'development'])) {
            $this->call([
                LocationSeeder::class,
                MahasiswaSeeder::class,
                AdminSeeder::class,
                UsersSeeder::class,
                DetailSkripsiSeeder::class,
                KonsultasiSeeder::class,
                AnonimNameSeeder::class
            ]);
        }
    }
}
