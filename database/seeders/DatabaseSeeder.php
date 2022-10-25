<?php

namespace Database\Seeders;

use Database\Seeders\Dev\AdminSeeder;
use Database\Seeders\Dev\UsersSeeder;
use Database\Seeders\Simulasi\SatkerSeeder;
use Database\Seeders\System\LocationSeeder;
use Database\Seeders\System\PermissionSeeder;
use Database\Seeders\System\RoleSeeder;
use Database\Seeders\Users\AnonimNameSeeder;
use Database\Seeders\Users\DetailMahasiswaSeeder;
use Database\Seeders\Users\DetailSkripsiSeeder;
use Database\Seeders\Users\MahasiswaSeeder;
use Database\Seeders\Users\UsersFormationSeeder;
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
        ]);

        if (App::environment(['local', 'development'])) {
            $this->call([
                LocationSeeder::class,

                AdminSeeder::class,
                UsersSeeder::class,

                MahasiswaSeeder::class,
                DetailSkripsiSeeder::class,
                DetailMahasiswaSeeder::class,
                UsersFormationSeeder::class,
                AnonimNameSeeder::class,

                SatkerSeeder::class,
            ]);
        }
    }
}
