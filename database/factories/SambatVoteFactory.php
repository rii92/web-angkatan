<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SambatVoteFactory extends Factory
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
            'sambat_id' => rand(1,20),
            'is_upvote' => rand(0,1)
        ];
    }
}