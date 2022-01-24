<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SambatTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sambat_id' => rand(1,20),
            'tag_id' => rand(1, 10)
        ];
    }
}