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
        User::updateOrCreate([
            'email' => 'billy@alope.id',
        ], [
            'name' => 'Billy Jonathan',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);
        
        User::updateOrCreate([
            'email' => 'dikri@alope.id',
        ], [
            'name' => 'Dikri Fauzan Amrulloh',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        User::updateOrCreate([
            'email' => 'masnun@alope.id',
        ], [
            'name' => 'Masnun Muhaemin',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        // Data 1 User
        User::updateOrCreate([
            'email' => 'fatra@alope.id',
        ], [
            'name' => 'Mr.Fatra',
            'password' => Hash::make('password123'),
            'role' => 'User',
        ]);
    }
}
