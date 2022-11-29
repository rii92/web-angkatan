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

                $location = Location::where("kabupaten", $data[1])->first();

                Satker::updateOrCreate([
                    "kode_wilayah" => $data[2],
                    "name" => $data[3],
                    "se" => $data[4],
                    "sk" => $data[5],
                    "si" => $data[6],
                    "sd" => $data[7],
                    "d3" => $data[8],
                    "ks" => $data[9],
                    "st" => $data[10],
                    "location_id" => $location->id,
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
