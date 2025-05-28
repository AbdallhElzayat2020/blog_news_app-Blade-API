<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
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
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->paragraph(),
            'subject' => fake()->sentence(3),
            'status' => fake()->randomElement(['pending', 'read', 'replied']),
            'ip_address' => fake()->ipv4(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
