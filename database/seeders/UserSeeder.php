<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Data 1 User
        User::create([
            'name' => 'Mr.Fatra',
            'email' => 'fatra@alope.id',
            'password' => Hash::make('password123'),
            'role' => 'User',
        ]);
    }
}
