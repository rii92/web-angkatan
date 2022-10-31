<?php

namespace Database\Seeders\Users;

use App\Constants\AppRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = App::environment(['local', 'development']) ? 'patrickstar' : Str::random(10);
        $password = Hash::make($password);

        $csvFile = fopen(base_path("database/data/users/mahasiswa.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $user = User::create([
                'name' => $data[1],
                'email' => $data[2] . '@stis.ac.id',
                'password' => $password
            ]);

            $details = [
                'nim' => $data[2],
                'kelas' => $data[0],
                'skripsi_dosbing' => $data[3],
                'pa_divisi' => $data[4],
                'pa_jabatan' => $data[5]
            ];
            $user->details()->create($details);

            $angkatan = $data[6];

            if ($angkatan == '61') $user->assignRole(AppRoles::D3_61);
            else if (($angkatan == '60') && ($details['kelas'] == 'Alum')) $user->assignRole(AppRoles::ALUMNI);
            else $user->assignRole(AppRoles::USERS);


            if ($details['pa_divisi']) {
                $user->assignRole(AppRoles::MEMBER);

                switch ($details['pa_divisi']) {
                    case 'BPH':
                        $user->assignRole(AppRoles::BPH);
                        break;
                    case 'Akademik':
                        $user->assignRole(AppRoles::AKADEMIK);
                        break;
                    case 'Humas':
                        $user->assignRole(AppRoles::HUMAS);
                        break;
                    case 'TI':
                        $user->assignRole(AppRoles::ADMIN);
                        break;
                    case 'EO':
                        $user->assignRole(AppRoles::EO);
                        break;
                    case 'Danus':
                        $user->assignRole(AppRoles::DANUS);
                        break;
                    case 'Pubdok':
                        $user->assignRole(AppRoles::PUBDOK);
                        break;
                }
            }

            // give admin menu permisson for all coordinator
            if ($details['pa_jabatan'] == "Koordinator") $user->assignRole(AppRoles::KOOR);
        }
        fclose($csvFile);
    }
}
