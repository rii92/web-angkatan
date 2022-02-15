<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SambatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'user_id' => rand(1,20),
            'description' => $this->faker->text(),
            'is_anonim' => rand(0,1)
        ];
    }
}