<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->paragraph(),
            'user_id' => 1,  // Assume admin user ID 1
            'category_id' => fake()->numberBetween(1, 5),
            'is_active' => fake()->randomElement(['Yes', 'No']),
        ];
    }
}
