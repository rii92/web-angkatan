<?php

namespace Database\Seeders\Features;

use App\Constants\AppRoles;
use App\Models\Konsul;
use App\Models\KonsulChat;
use App\Models\Tag;
use App\Models\User;
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
        $tags = Tag::factory()->count(40)->create();
        
        Konsul::factory(150)
            ->has(KonsulChat::factory()->count(3)->for(User::role(AppRoles::USERS)->has('details')->inRandomOrder()->first()), "chats")
            ->hasAttached($tags)
            ->create();
    }
}
