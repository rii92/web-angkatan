<?php

namespace Database\Seeders\Simulasi;


use App\Models\Simulations;
use App\Models\SimulationsTime;
use Illuminate\Database\Seeder;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Simulations::factory(1)
            ->has(SimulationsTime::factory()->count(rand(3, 5)), 'times')
            ->create();
    }
}
