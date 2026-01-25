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
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Belajar pembuatan website modern menggunakan framework populer.',
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'Pengembangan aplikasi mobile untuk Android dan iOS.',
            ],
            [
                'name' => 'Data Science',
                'description' => 'Analisis data, machine learning, dan pengolahan statistik.',
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Strategi pemasaran digital, SEO, dan iklan berbayar.',
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Perancangan antarmuka dan pengalaman pengguna yang menarik.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'id' => (string) Str::uuid(),
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
