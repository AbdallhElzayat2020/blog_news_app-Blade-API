<?php

namespace Database\Factories;

use App\Models\Post;
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
        $date = fake()->date('Y-m-d H:i:s');
        return [
            'comment' => fake()->paragraph(2),
            'status' => fake()->randomElement(['active', 'inactive']),
            'ip_address' => fake()->ipv4(),
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => Post::inRandomOrder()->first()->id,
            'created_at' => $date,
            'updated_at' => $date,

        ];
    }
}
