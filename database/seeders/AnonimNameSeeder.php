<?php

namespace Database\Seeders;

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
        foreach (UserDetails::all() as $user)
            $user->update(['anonim_name' => Str::lower($user->jurusan . '-' . $user->user_id)]);
    }
}
