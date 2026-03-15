@extends('layouts.template')

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    {{-- Header & Search --}}
    <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white">
        <div class="flex flex-col gap-1">
            <h2 class="text-lg font-bold text-gray-800">{{ $title }}</h2>
            <p class="text-sm text-gray-500">Total data: {{ $courses->total() }} course terdaftar.</p>
        </div>
        <div class="flex gap-3 w-full sm:w-auto">
            <form action="{{ route('course') }}" method="GET" class="relative w-full sm:w-64">
                <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 focus:outline-none group cursor-pointer">
                    <i data-lucide="search"
                        class="w-4 h-4 text-gray-400 group-hover:text-primary transition-colors"></i>
                </button>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..."
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
            </form>

            <button onclick="openModal('addCourseModal')"
                class="bg-primary hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 shadow-lg shadow-blue-500/30 cursor-pointer">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Add Course</span>
            </button>
        </div>
    </div>

    {{-- Table Course --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-200">
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Course Info</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Visibility</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Action
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($courses as $course)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            {{-- Cover Image Course --}}
                            <div class="w-16 h-10 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                                @if ($course->cover)
                                <img src="{{ asset('storage/' . $course->cover) }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 line-clamp-1">{{ $course->title }}</p>
                                <p class="text-xs text-gray-500 line-clamp-1">
                                    {{ Str::limit($course->description, 50) }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $course->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                        <span
                            class="px-2.5 py-1 rounded-full text-xs font-medium {{ $course->visibility == 'public' ? 'bg-green-50 text-green-700 border-green-100' : 'bg-gray-50 text-gray-700 border-gray-100' }}">
                            {{ ucfirst($course->visibility) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('course.show', $course->id) }}"
                                class="p-2 text-green-600 bg-green-50 hover:bg-green-100 rounded-lg transition-all border border-green-100 cursor-pointer">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <button
                                data-course='@json($course)'
                                onclick="openEditModal(this)"
                                class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all border border-blue-100 cursor-pointer">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <button onclick="openDeleteModal('{{ $course->id }}', '{{ $course->title }}')"
                                class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all border border-red-100 cursor-pointer">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center gap-2">
                            <i data-lucide="folder-open" class="w-10 h-10 text-gray-300"></i>
                            <p>Belum ada course yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        {{ $courses->links('pagination::tailwind') }}
    </div>
</div>
@endsection

@section('modal')
{{-- MODAL CREATE COURSE --}}
<div id="addCourseModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm transition-all">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="book-plus" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Create New Course</h3>
                </div>
                <button onclick="closeModal('addCourseModal')"
                    class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Course Title</label>
                        <input type="text" name="title" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category</label>
                        <select name="category_id" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all bg-white cursor-pointer">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visibility</label>
                        <select name="visibility" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all bg-white cursor-pointer">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Course Cover</label>

                        {{-- PERBAIKAN: Gunakan <label> sebagai pembungkus utama agar seluruh kotak bisa diklik --}}
                        <label for="file-upload"
                            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-primary hover:bg-blue-50/50 transition-all cursor-pointer group overflow-hidden">

                            {{-- Input File Disembunyikan tapi tetap bekerja --}}
                            {{-- PENTING: accept=".jpg,.jpeg,.png,.webp" untuk mencegah delay --}}
                            <input id="file-upload" name="cover" type="file" class="sr-only"
                                accept=".jpg, .jpeg, .png, .webp" onchange="previewImage(event, 'preview-image')">

                            {{-- Container Preview Image (Akan muncul menutupi kotak saat gambar dipilih) --}}
                            <img id="preview-image"
                                class="hidden absolute inset-0 w-full h-full object-cover z-10 opacity-90 hover:opacity-100 transition-opacity" />

                            {{-- Tampilan Default (Icon & Teks) --}}
                            <div class="space-y-1 text-center relative z-0">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-100 transition-colors">
                                    <i data-lucide="image"
                                        class="h-6 w-6 text-gray-400 group-hover:text-primary transition-colors"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span class="font-medium text-primary group-hover:text-blue-700">Click to
                                        upload</span>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG up to 2MB</p>
                            </div>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                        <textarea name="description" rows="3" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('addCourseModal')"
                        class="flex-1 px-4 py-3 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition-all font-bold cursor-pointer">Cancel</button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-primary text-white rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all font-bold cursor-pointer">Publish
                        Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT COURSE --}}
<div id="editCourseModal"
    class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm transition-all">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                        <i data-lucide="edit" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Edit Course</h3>
                </div>
                <button onclick="closeModal('editCourseModal')"
                    class="text-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form id="editCourseForm" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Course Title</label>
                        <input type="text" name="title" id="edit_title" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category</label>
                        <select name="category_id" id="edit_category_id" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all bg-white cursor-pointer">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visibility</label>
                        <select name="visibility" id="edit_visibility" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all bg-white cursor-pointer">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Course Cover (Leave blank to
                            keep current)</label>
                        <label for="edit_file-upload"
                            class="relative flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-primary hover:bg-blue-50/50 transition-all cursor-pointer group overflow-hidden">
                            <input id="edit_file-upload" name="cover" type="file" class="sr-only"
                                accept=".jpg, .jpeg, .png, .webp"
                                onchange="previewImage(event, 'edit_preview-image')">
                            <img id="edit_preview-image"
                                class="hidden absolute inset-0 w-full h-full object-cover z-10 opacity-90 hover:opacity-100 transition-opacity" />
                            <div class="space-y-1 text-center relative z-0">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-100 transition-colors">
                                    <i data-lucide="image"
                                        class="h-6 w-6 text-gray-400 group-hover:text-primary transition-colors"></i>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span class="font-medium text-primary group-hover:text-blue-700">Click to
                                        upload</span>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG up to 2MB</p>
                            </div>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                        <textarea name="description" id="edit_description" rows="3" required
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('editCourseModal')"
                        class="flex-1 px-4 py-3 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition-all font-bold cursor-pointer">Cancel</button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-primary text-white rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all font-bold cursor-pointer">Update
                        Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL DELETE --}}
<div id="deleteCourseModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm transition-all">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="alert-triangle" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Delete Course?</h3>
            <p class="text-gray-500 mb-6">Are you sure you want to delete <span id="delete_course_title"
                    class="font-bold text-gray-800"></span>?</p>
            <form id="deleteCourseForm" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('deleteCourseModal')"
                    class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 font-medium cursor-pointer">Cancel</button>
                <button type="submit"
                    class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 shadow-lg shadow-red-500/30 font-medium cursor-pointer">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
        
        // Reset preview images saat modal ditutup
        if (id === 'addCourseModal') {
            const preview = document.getElementById('preview-image');
            if (preview) {
                preview.classList.add('hidden');
                preview.src = '';
            }
            document.getElementById('file-upload').value = '';
        } else if (id === 'editCourseModal') {
            const editPreview = document.getElementById('edit_preview-image');
            if (editPreview) {
                editPreview.classList.add('hidden');
                editPreview.src = '';
            }
            document.getElementById('edit_file-upload').value = '';
        }
    }

    function openEditModal(button) {
        const course = JSON.parse(button.dataset.course);

        document.getElementById('edit_title').value = course.title;
        document.getElementById('edit_category_id').value = course.category_id;
        document.getElementById('edit_visibility').value = course.visibility;
        document.getElementById('edit_description').value = course.description;
        document.getElementById('editCourseForm').action = `/course/${course.id}/update`;

        // Reset preview image saat modal dibuka
        const editPreview = document.getElementById('edit_preview-image');
        if (editPreview) {
            editPreview.classList.add('hidden');
            editPreview.src = '';
        }
        document.getElementById('edit_file-upload').value = '';

        openModal('editCourseModal');
    }

    function openDeleteModal(id, title) {
        document.getElementById('delete_course_title').innerText = title;
        document.getElementById('deleteCourseForm').action = `/course/${id}/destroy`;
        openModal('deleteCourseModal');
    }

    function previewImage(event, previewId = 'preview-image') {
        const reader = new FileReader();
        const preview = document.getElementById(previewId);

        reader.onload = () => {
            preview.src = reader.result;
            preview.classList.remove('hidden');
        };

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }


    const searchInput = document.querySelector('input[name="search"]');
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });

        if (searchInput.value) {
            searchInput.focus();
            const val = searchInput.value;
            searchInput.value = '';
            searchInput.value = val;
        }
    }
</script>
@endsection

