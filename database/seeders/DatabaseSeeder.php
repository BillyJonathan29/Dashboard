<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'User',
        ]);

        User::create([
            'name' => 'Billy Jonathan',
            'email' => 'billy@alope.id',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Masnun Muhaemin',
            'email' => 'masnun@alope.id',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);


        User::create([
            'name' => 'Mr.Fatra',
            'email' => 'fatra@alope.id',
            'password' => Hash::make('password123'),
            'role' => 'User',
        ]);
    }
}
