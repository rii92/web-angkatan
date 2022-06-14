<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AlterEmailUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('name', "Tias Arta Putra")->update(['email' => '211710032@stis.ac.id']);
    }
}
