<?php

namespace Database\Seeders;

use App\Models\Konsul;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(40)->create();
        Konsul::factory(50)->create();
    }
}
