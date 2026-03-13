<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'id' => (string) Str::uuid(),
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Courses about web development'
            ]);
        }
        $courses = [
            [
                'title' => 'Complete Laravel Guide',
                'description' => 'Master Laravel 11 from scratch to advanced concepts.',
                'cover' => 'courses/dummy-laravel.jpg',
                'visibility' => 'public',
                'category_id' => $category->id,
            ],
            [
                'title' => 'React JS for Beginners',
                'description' => 'Learn the basics of React JS including Hooks and Context API.',
                'cover' => 'courses/dummy-react.jpg',
                'visibility' => 'public',
                'category_id' => $category->id,
            ],
            [
                'title' => 'UI/UX Design Masterclass',
                'description' => 'Design beautiful user interfaces using Figma and Adobe XD.',
                'cover' => 'courses/dummy-uiux.jpg',
                'visibility' => 'private',
                'category_id' => $category->id,
            ],
            [
                'title' => 'Python for Data Science',
                'description' => 'Analyze data and create visualizations with Python.',
                'cover' => 'courses/dummy-python.jpg',
                'visibility' => 'public',
                'category_id' => $category->id,
            ],
            [
                'title' => 'Digital Marketing Strategy',
                'description' => 'Learn how to market products effectively online.',
                'cover' => 'courses/dummy-marketing.jpg',
                'visibility' => 'public',
                'category_id' => $category->id,
            ],
        ];

        foreach ($courses as $course) {
            $course['id'] = (string) Str::uuid();
            $course['slug'] = \Illuminate\Support\Str::slug($course['title']);
            Course::create($course);
        }
    }
}
