<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::orderBy('name', 'asc')->get();
        $courses = Course::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('course.index', [
            'title' => 'All Courses',
            'courses' => $courses,
            'categories' => $categories,
            'breadcrumbs' => [
                ['title' => 'Content Management', 'link' => route('course')],
                ['title' => 'Course', 'link' => route('course')]
            ]
        ]);
    }
    public function show(Course $course)
    {
        return view('course.show', [
            'title' => 'Course Detail',
            'course' => $course->load('category'),
            'breadcrumbs' => [
                ['title' => 'Content Management', 'link' => route('course')],
                ['title' => 'Course', 'link' => route('course')],
                ['title' => 'Detail Course', 'link' => route('course.show', $course->id)]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'visibility' => 'required|in:public,private',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $data = $request->except('cover');
            $data['slug'] = Str::slug($request->title);

            // Handle Image Upload
            if ($request->hasFile('cover')) {
                $data['cover'] = $request->file('cover')->store('courses', 'public');
            }

            Course::create($data);

            return redirect()->route('course')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            if (isset($data['cover']) && Storage::disk('public')->exists($data['cover'])) {
                Storage::disk('public')->delete($data['cover']);
            }
            return redirect()->back()->with('error', 'Failed to create course: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'visibility' => 'required|in:public,private',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $data = $request->except('cover');
            $data['slug'] = Str::slug($request->title);

            if ($request->hasFile('cover')) {
                // Delete old image if exists
                if ($course->cover && Storage::disk('public')->exists($course->cover)) {
                    Storage::disk('public')->delete($course->cover);
                }
                $data['cover'] = $request->file('cover')->store('courses', 'public');
            }

            $course->update($data);

            return redirect()->route('course')->with('success', 'Course updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update course: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Course $course)
    {
        try {
            if ($course->cover && Storage::disk('public')->exists($course->cover)) {
                Storage::disk('public')->delete($course->cover);
            }

            $course->delete();

            return redirect()->route('course')->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete course: ' . $e->getMessage());
        }
    }
}
