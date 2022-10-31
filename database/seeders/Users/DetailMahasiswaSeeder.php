<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Seeder;

class DetailMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/users/details_mahasiswa.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $user = User::where('email', $data[1] . "@stis.ac.id")->first();

            if (!$user) continue;

            $user->details->update([
                "no_hp" => $data[3],
                "no_hp_ayah" => $data[6],
                "no_hp_ibu" => $data[7],
                "no_hp_wali" => $data[8],
                "alamat_rumah" => $data[4],
                "alamat_kos" => $data[5],
            ]);
        }
        fclose($csvFile);
    }
}
