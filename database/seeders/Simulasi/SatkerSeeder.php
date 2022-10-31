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
                    "se_formation" => $data[2],
                    "sk_formation" => $data[3],
                    "si_formation" => $data[4],
                    "sd_formation" => $data[5],
                    "d3_formation" => $data[6],
                    "ks_formation" => $data[7],
                    "st_formation" => $data[8]
                ]);  
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
