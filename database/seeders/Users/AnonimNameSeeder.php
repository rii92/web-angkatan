<?php

namespace Database\Seeders\Users;

use App\Models\UserDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnonimNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (UserDetails::all() as $userDetail)
            $userDetail->update(['anonim_name' => Str::lower($userDetail->jurusan_short . '-' . $userDetail->user_id)]);
    }
}
