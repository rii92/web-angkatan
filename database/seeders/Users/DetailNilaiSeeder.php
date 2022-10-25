<?php

namespace Database\Seeders\Users;

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
            // if (!$firstline) {
            //     $userDetails = UserDetails::where("nim", $data[0])->first();

            //     $userDetails->jurusan = $data[3];
            //     $userDetails->peminatan = $data[4];

            //     $userDetails->save();

            //     UsersFormation::updateOrCreate([
            //         "ipk" => (float) $data[2],
            //         "rank_jurusan" => (int) $data[5],
            //         "rank_peminatan" => (int) $data[6]
            //     ], ["user_id" => $userDetails->user_id]);
            // }
            // $firstline = false;
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $user = User::where('email', $data[0] . "@stis.ac.id")->first();

            if (!$user) continue;

            $user->details->update([
                "ipk" => (float) $data[2],
                "rank_jurusan" => (int) $data[5],
                "rank_peminatan" => (int) $data[6]
            ]);
        }
        fclose($csvFile);
    }
}
