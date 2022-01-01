<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DetailSkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/details_skripsi.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $user = User::where('email', $data[0] . "@stis.ac.id")->first();
                $user->details->update([
                    "skripsi_dosbing" => $data[1],
                    "skripsi_judul" => $data[2],
                    "skripsi_metode" => $data[3],
                    "skripsi_variabel_dependent" => $data[4],
                    "skripsi_variabel_independent" => $data[5],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
