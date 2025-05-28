<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date('Y-m-d H:i:s');
        $data = [
            'technology Category',
            'health Category',
            'education Category',
            'business Category',
            'lifestyle Category',
            'travel Category',
            'sports Category',
        ];

        foreach ($data as $category_name) {
            Category::create([
                'name' => $category_name,
                'slug' => Str::slug($category_name),
                'icon' => fake()->randomElement(['fa-solid fa-laptop', 'fa-solid fa-heart', 'fa-solid fa-book', 'fa-solid fa-briefcase', 'fa-solid fa-life-ring', 'fa-solid fa-plane', 'fa-solid fa-futbol']),
                'description' => fake()->sentence(),
                'status' => fake()->randomElement(['active', 'inactive']),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        };
    }
}
