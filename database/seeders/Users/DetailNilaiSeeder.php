<?php

namespace Database\Seeders\Users;

use App\Constants\AppPermissions;
use App\Models\User;
use Illuminate\Database\Seeder;

class DetailNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/users/details_nilai.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $user = User::where('email', $data[0] . "@stis.ac.id")->first();

            if (!$user) continue;

            $user->details()->update([
                "ipk" => (float) $data[2],
                "jurusan" => $data[3],
                "peminatan" => $data[4],
                "rank_jurusan" => (int) $data[5],
                "rank_peminatan" => (int) $data[6]
            ]);

            $user->givePermissionTo(AppPermissions::SIMULATION_ACCESS);
        }
        fclose($csvFile);
    }
}
