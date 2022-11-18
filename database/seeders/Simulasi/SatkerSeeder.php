<?php

namespace Database\Seeders\Simulasi;

use App\Models\Location;
use App\Models\Satker;
use Illuminate\Database\Seeder;

class SatkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/simulasi/satker.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $location = Location::where("kabupaten", $data["1"])->first();

                Satker::updateOrCreate([
                    "name" => $data[0],
                    "location_id" => $location->id,
                    "se" => $data[2],
                    "sk" => $data[3],
                    "si" => $data[4],
                    "sd" => $data[5],
                    "d3" => $data[6],
                    "ks" => $data[7],
                    "st" => $data[8]
                ]);  
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
