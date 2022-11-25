<?php

namespace Database\Seeders\System;

use App\Models\Location;
use Illuminate\Database\Seeder;

class NonBPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/system/location_non_bps.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Location::create([
                    "kabupaten" => $data['2'],
                    "provinsi" => $data['3'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
