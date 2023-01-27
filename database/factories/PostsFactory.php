<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->name(),
            "content" => $this->faker->safeEmail,
            "image" => $this->faker->phoneNumber,
            "type" => $this->faker->numberBetween(25, 45),

        ];
    }
}
