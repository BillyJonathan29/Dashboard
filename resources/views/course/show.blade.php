@extends('layouts.template')

@section('content')
<div class="flex flex-col gap-6">
    <a href="{{ route('course') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-primary transition-colors group">
        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
        Back to Courses
    </a>
    {{-- Course Detail Card --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Course Cover Image --}}
            <div class="w-full md:w-5/12 lg:w-4/12 flex-shrink-0">
                <div class="aspect-video bg-gray-50 rounded-xl overflow-hidden shadow-sm border border-gray-100 relative group">
                    @if ($course->cover)
                    <img src="{{ asset('storage/' . $course->cover) }}" alt="{{ $course->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                        <i data-lucide="image" class="w-12 h-12 mb-3 text-gray-300"></i>
                        <span class="text-sm font-medium">No Cover Image</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Course Info --}}
            <div class="flex flex-col flex-1">
                <div class="flex items-center gap-3 mb-4">
                    <span
                        class="px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 shadow-sm">
                        {{ $course->category->name ?? 'Uncategorized' }}
                    </span>
                    <span
                        class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm {{ $course->visibility == 'public' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-700 border border-gray-200' }}">
                        {{ ucfirst($course->visibility) }}
                    </span>
                </div>

                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 leading-tight">{{ $course->title }}</h2>

                <div class="flex flex-wrap items-center gap-4 text-gray-500 text-sm mb-6 bg-gray-50 p-3 rounded-lg border border-gray-100 inline-flex w-fit">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-primary"></i>
                        <span>Created: {{ $course->created_at?->format('M d, Y') ?? 'Unknown' }}</span>
                    </div>
                    <div class="w-1 h-1 bg-gray-300 rounded-full hidden sm:block"></div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-primary"></i>
                        <span>Updated: {{ $course->updated_at?->diffForHumans() ?? 'Unknown' }}</span>
                    </div>
                </div>

                <div class="prose max-w-none">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 border-b border-gray-100 pb-2">Description</h3>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line text-sm sm:text-base">
                        {{ $course->description ?? 'No description provided for this course.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection