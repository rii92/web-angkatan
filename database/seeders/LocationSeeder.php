<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();

        $csvFile = fopen(base_path("database/data/location.csv"), "r");

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
