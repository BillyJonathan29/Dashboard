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
        // User::updateOrCreate([
        //     'email' => 'billy@alope.id',
        // ], [
        //     'name' => 'Billy Jonathan',
        //     'password' => Hash::make('password123'),
        //     'role' => 'Admin',
        // ]);

        // User::updateOrCreate([
        //     'email' => 'dikri@alope.id',
        // ], [
        //     'name' => 'Dikri Fauzan Amrulloh',
        //     'password' => Hash::make('password123'),
        //     'role' => 'Admin',
        // ]);

        // User::updateOrCreate([
        //     'email' => 'masnun@alope.id',
        // ], [
        //     'name' => 'Masnun Muhaemin',
        //     'password' => Hash::make('password123'),
        //     'role' => 'Admin',
        // ]);

        // // Data 1 User
        // User::updateOrCreate([
        //     'email' => 'fatra@alope.id',
        // ], [
        //     'name' => 'Mr.Fatra',
        //     'password' => Hash::make('password123'),
        //     'role' => 'User',
        // ]);

        $users = [
            ['name' => 'Billy Jonathan', 'email' => 'billy@alope.id', 'role' => 'Admin'],
            ['name' => 'Dikri Fauzan Amrulloh', 'email' => 'dikri@alope.id', 'role' => 'Admin'],
            ['name' => 'Masnun Muhaemin', 'email' => 'masnun@alope.id', 'role' => 'Admin'],
            ['name' => 'Mr. Fatra', 'email' => 'fatra@alope.id', 'role' => 'User'],

            ['name' => 'Andi Saputra', 'email' => 'andi@alope.id', 'role' => 'User'],
            ['name' => 'Budi Santoso', 'email' => 'budi@alope.id', 'role' => 'User'],
            ['name' => 'Cahyo Pratama', 'email' => 'cahyo@alope.id', 'role' => 'User'],
            ['name' => 'Dimas Prasetyo', 'email' => 'dimas@alope.id', 'role' => 'User'],
            ['name' => 'Eka Putra', 'email' => 'eka@alope.id', 'role' => 'User'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@alope.id', 'role' => 'User'],
            ['name' => 'Gilang Ramadhan', 'email' => 'gilang@alope.id', 'role' => 'User'],
            ['name' => 'Hendra Wijaya', 'email' => 'hendra@alope.id', 'role' => 'User'],
            ['name' => 'Indra Kurniawan', 'email' => 'indra@alope.id', 'role' => 'User'],
            ['name' => 'Joko Susanto', 'email' => 'joko@alope.id', 'role' => 'User'],
            ['name' => 'Kevin Pratama', 'email' => 'kevin@alope.id', 'role' => 'User'],
            ['name' => 'Lukman Hakim', 'email' => 'lukman@alope.id', 'role' => 'User'],
            ['name' => 'M Rizky', 'email' => 'rizky@alope.id', 'role' => 'User'],
            ['name' => 'Naufal Hidayat', 'email' => 'naufal@alope.id', 'role' => 'User'],
            ['name' => 'Oka Pratama', 'email' => 'oka@alope.id', 'role' => 'User'],
            ['name' => 'Putra Mahendra', 'email' => 'putra@alope.id', 'role' => 'User'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password123'),
                    'role' => $user['role'],
                ]
            );
        }
    }
}
