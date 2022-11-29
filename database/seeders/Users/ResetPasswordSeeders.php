<?php

namespace Database\Seeders\Users;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResetPasswordSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/users/bulk-reset-password.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if ($firstline) {
                $firstline = false;
                continue;
            }

            $user = User::where('email', $data[1] . "")->first();

            if (!$user) continue;

            $user->password = Hash::make($data[2]);
            $user->save();
        }
        fclose($csvFile);
    }
}
