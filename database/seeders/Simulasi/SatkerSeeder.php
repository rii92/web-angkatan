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
                $location = Location::where("kabupaten", $data[2])->first();

                Satker::updateOrCreate([
                    "kode_wilayah" => $data[0],
                    "name" => $data[1],
                    "se" => $data[3],
                    "sk" => $data[4],
                    "si" => $data[5],
                    "sd" => $data[6],
                    "d3" => $data[7],
                    "ks" => $data[8],
                    "st" => $data[9],
                    "location_id" => $location->id,
                ]);  
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
