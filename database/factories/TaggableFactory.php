<?php

namespace Database\Factories;

use App\Models\Sambat;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaggableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => rand(1, 10),
            'taggable_type' => Sambat::class,
            'taggable_id' => rand(1,20)
        ];
    }
}