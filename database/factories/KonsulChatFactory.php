<?php

namespace Database\Factories;

use App\Constants\AppKonsul;
use Illuminate\Database\Eloquent\Factories\Factory;

class KonsulChatFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => AppKonsul::TYPE_CHAT_TEXT,
            'is_admin' => $this->faker->boolean(),
            'is_seen' => true,
            'chat' => $this->faker->paragraph(rand(1, 20)),
            'created_at' => $this->faker->dateTimeBetween('-20days')
        ];
    }
}
