<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $modules = Module::with(['course', 'publisher'])
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        $courses = Course::latest()->get();
        $publishers = User::orderBy('name')->get(['id', 'name']);
        $title = 'Manage Module';

        return view('module.index', [
            'title' => $title,
            'modules' => $modules,
            'courses' => $courses,
            'publishers' => $publishers,
            'breadcrumbs' => [
                ['title' => 'Content Management', 'link' => route('module')],
                ['title' => 'Module', 'link' => route('module')]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'publisher_id' => 'nullable|exists:users,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string',
            'body' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('articles', 'public');
        }

        Module::create($validated);

        return redirect()->back()->with('success', 'Module created successfully.');
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'publisher_id' => 'nullable|exists:users,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string',
            'body' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover')) {
            if ($module->cover && Storage::disk('public')->exists($module->cover)) {
                Storage::disk('public')->delete($module->cover);
            }
            $validated['cover'] = $request->file('cover')->store('modules', 'public');
        }

        $module->update($validated);

        return redirect()->back()->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module)
    {
        if ($module->cover && Storage::disk('public')->exists($module->cover)) {
            Storage::disk('public')->delete($module->cover);
        }

        $module->delete();

        return redirect()->back()->with('success', 'Article deleted successfully.');
    }
}
