<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
        $date = fake()->date('Y-m-d H:i:s');

        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(5),
            'status' => fake()->randomElement(['active', 'inactive']),
            'comment_able' => fake()->randomElement(['yes', 'no']),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'created_at' => $date,
            'updated_at' => $date,
            // slug is comming dynamically from the package
        ];
    }
}
