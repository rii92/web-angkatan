<?php

namespace Database\Factories;

use App\Models\SimulationsTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulationsTimeFactory extends Factory
{
    protected $model = SimulationsTime::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-5 days', '+5 days');

        return [
            'start_time' => $start,
            'end_time' => $this->faker->dateTimeBetween($start, '+5 days')
        ];
    }
}
