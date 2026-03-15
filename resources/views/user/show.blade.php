@extends('layouts.template')

@section('content')
    <div class="flex flex-col gap-6">
        {{-- User Profile Card --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
            <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">
                <img class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-blue-50 shadow-md"
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=fff&size=128"
                    alt="{{ $user->name }}">

                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <div class="flex items-center justify-center sm:justify-start gap-4 text-gray-500">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span class="text-sm">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span class="text-sm">Joined {{ $user->created_at?->format('M d, Y') ?? 'null' }}</span>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center justify-center sm:justify-start gap-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 capitalize border border-blue-100">
                            {{ $user->role }}
                        </span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Active
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enrolled Courses Section --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Enrolled Courses</h3>
                        <p class="text-sm text-gray-500">{{ $user->courses->count() }} courses actively followed</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                @if ($user->courses->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($user->courses as $course)
                            <div
                                class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow group flex flex-col bg-white">
                                {{-- Course Image --}}
                                <div class="relative w-full aspect-video bg-gray-100 overflow-hidden">
                                    @if ($course->cover)
                                        <img src="{{ asset('storage/' . $course->cover) }}" alt="{{ $course->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                            <i data-lucide="image" class="w-10 h-10 mb-2"></i>
                                            <span class="text-sm">No Cover</span>
                                        </div>
                                    @endif

                                    <div class="absolute top-3 right-3 flex gap-2">
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 text-gray-700 backdrop-blur-sm shadow-sm">
                                            {{ $course->category->name ?? 'Course' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Course Content --}}
                                <div class="p-4 flex flex-col flex-grow">
                                    <h4
                                        class="font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-primary transition-colors">
                                        {{ $course->title }}
                                    </h4>
                                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                                        {{ $course->description ?? 'No description available for this course.' }}
                                    </p>

                                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                        <span class="inline-flex items-center gap-1 text-xs text-gray-500 font-medium">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                            Enrolled:
                                            {{ $course->pivot->created_at ? $course->pivot->created_at->format('M d, Y') : 'Unknown' }}
                                        </span>

                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                            <i data-lucide="book-x" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-1">No Courses Found</h4>
                        <p class="text-sm text-gray-500 max-w-sm">
                            {{ $user->name }} has not enrolled in any courses yet.
                        </p>
                    </div>
                @endif
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <a href="{{ route('user') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Users List
                </a>
            </div>
        </div>
    </div>
@endsection
