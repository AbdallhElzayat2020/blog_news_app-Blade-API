<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->paragraph(2),
            'ip_address' => fake()->ipv4(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'user_id' => User::inRandomOrder()->first()->id,

        ];
    }
}
