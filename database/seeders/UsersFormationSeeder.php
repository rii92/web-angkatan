<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\UsersFormation;
use Illuminate\Database\Seeder;

class UsersFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/user_formation.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                $userDetails = UserDetails::where("nim", $data[0])->first();

                $userDetails->jurusan = $data[3];
                $userDetails->peminatan = $data[4];

                $userDetails->save();

               UsersFormation::updateOrCreate([
                    "ipk" => (float) $data[2],
                    "rank_jurusan" => (int) $data[5],
                    "rank_peminatan" => (int) $data[6]
                ], ["user_id" => $userDetails->user_id]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
