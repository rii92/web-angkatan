<?php

namespace Database\Seeders;

use App\Models\Sambat;
use App\Models\SambatComment;
use App\Models\SambatTag;
use App\Models\SambatVote;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class SambatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory(10)->create();
        Sambat::factory(20)->create();
        SambatTag::factory(40)->create();
        SambatVote::factory(50)->create();
        SambatComment::factory(40)->create();
    }
}