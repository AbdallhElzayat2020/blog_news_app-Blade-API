<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date('Y-m-d H:i:s');

        Admin::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01212484233',
            'avatar' => fake()->imageUrl(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}
