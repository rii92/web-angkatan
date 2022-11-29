<?php

namespace Database\Seeders;

use Database\Seeders\Dev\AdminSeeder;
use Database\Seeders\Dev\UsersSeeder;
use Database\Seeders\Features\KonsultasiSeeder;
use Database\Seeders\Features\SambatSeeder;
use Database\Seeders\Simulasi\SatkerSeeder;
use Database\Seeders\Simulasi\SimulationSeeder;
use Database\Seeders\System\LocationSeeder;
use Database\Seeders\System\NonBPSSeeder;
use Database\Seeders\System\PermissionSeeder;
use Database\Seeders\System\RoleSeeder;
use Database\Seeders\Users\AnonimNameSeeder;
use Database\Seeders\Users\DetailMahasiswaSeeder;
use Database\Seeders\Users\DetailSkripsiSeeder;
use Database\Seeders\Users\DetailNilaiSeeder;
use Database\Seeders\Users\MahasiswaSeeder;
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
                // just run this middleware once
                LocationSeeder::class,
                NonBPSSeeder::class,

                // this middleware just for development
                AdminSeeder::class,
                UsersSeeder::class,

                // run this if you want to bulk update from data
                // be careful, this will reset everything from the
                // table. move to outside local/dev env to run it
                // on production.
                MahasiswaSeeder::class,
                DetailSkripsiSeeder::class,
                DetailMahasiswaSeeder::class,
                DetailNilaiSeeder::class,
                AnonimNameSeeder::class,

                SatkerSeeder::class,


                SambatSeeder::class,
                KonsultasiSeeder::class,

                SimulationSeeder::class
            ]);
        }

        // if (App::environment(['production'])) {
            // preparing simulation
            // $this->call([
                // NonBPSSeeder::class,
                // DetailNilaiSeeder::class,
                
                // SatkerSeeder::class,
            // ]);
        // }
    }
}
