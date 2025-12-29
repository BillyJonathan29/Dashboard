<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #334155;
            border-radius: 4px;
        }

        .dropdown-enter {
            transform: scale(0.95);
            opacity: 0;
        }

        .dropdown-enter-active {
            transform: scale(1);
            opacity: 1;
            transition: all 0.1s ease-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>

<body class="bg-gray-50 text-slate-800 antialiased overflow-x-hidden">

    <div id="backdrop" onclick="toggleSidebar()"
        class="fixed inset-0 bg-gray-900/50 z-40 hidden transition-opacity opacity-0 backdrop-blur-sm lg:hidden"></div>

    <aside id="sidebar"
        class="fixed top-0 left-0 z-50 h-screen w-64 bg-dark text-white smooth-transition transform -translate-x-full lg:translate-x-0 flex flex-col overflow-hidden shadow-2xl">
        <div class="h-16 flex items-center px-6 min-h-[4rem] transition-all duration-300" id="sidebar-header">
            <div class="flex items-center gap-3 font-bold text-xl tracking-tight w-full transition-all justify-start"
                id="logo-container">
                <div
                    class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white primary shadow-lg shadow-blue-900/50">
                    B
                </div>
                <span class="whitespace-nowrap sidebar-text opacity-100 transition-opacity duration-200">Dasboard<span
                        class="text-primary">Masnun</span></span>
            </div>
            <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white ml-auto">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-2 custom-scrollbar">
            @include('layouts.menu.admin')
        </nav>
    </aside>

    <div id="main-content" class="min-h-screen flex flex-col smooth-transition lg:ml-64 bg-slate-50/50">

        <header
            class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-30 px-4 sm:px-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()"
                    class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-primary focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                {{-- <h1 class="text-lg font-semibold text-gray-800 hidden sm:block">User Management</h1> --}}
            </div>

            <div class="flex items-center gap-2 sm:gap-4">

                <div class="relative ml-2">
                    <button onclick="toggleProfileMenu()" class="flex items-center gap-2 focus:outline-none"
                        id="user-menu-button">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff"
                            alt="{{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full ring-2 ring-gray-100 hover:ring-primary transition-all object-cover">

                        <div class="hidden md:block text-left">
                            <p class="text-sm font-semibold text-gray-700 leading-none">
                                {{ explode(' ', Auth::user()->name)[0] }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 hidden md:block"></i>
                    </button>

                    <div id="profile-dropdown"
                        class="hidden absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-2xl ring-opacity-5 divide-y divide-gray-100 transform opacity-0 scale-95 transition-all duration-200 z-50 origin-top-right">

                        <div class="px-6 py-5">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-sm font-medium text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="py-2">
                            <a href="#"
                                class="group flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                <i data-lucide="user" class="mr-3 w-5 h-5 text-gray-400 group-hover:text-primary"></i>
                                Edit profile
                            </a>
                            <a href="#"
                                class="group flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                <i data-lucide="settings"
                                    class="mr-3 w-5 h-5 text-gray-400 group-hover:text-primary"></i>
                                Account settings
                            </a>
                            <a href="#"
                                class="group flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                <i data-lucide="help-circle"
                                    class="mr-3 w-5 h-5 text-gray-400 group-hover:text-primary"></i>
                                Support
                            </a>
                        </div>

                        <div class="py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full group flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    <i data-lucide="log-out"
                                        class="mr-3 w-5 h-5 text-gray-400 group-hover:text-red-500"></i>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8">

            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary transition-colors group">
                            <i data-lucide="home" class="w-4 h-4 mr-2 group-hover:text-primary"></i>
                            Dashboard
                        </a>
                    </li>

                    @if (isset($breadcrumbs))
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li>
                                <div class="flex items-center">
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>

                                    @if ($loop->last)
                                        <span class="ml-1 text-sm font-semibold text-gray-800 md:ml-2">
                                            {{ $breadcrumb['title'] }}
                                        </span>
                                    @else
                                        <a href="{{ $breadcrumb['link'] }}"
                                            class="ml-1 text-sm font-medium text-gray-500 hover:text-primary transition-colors md:ml-2">
                                            {{ $breadcrumb['title'] }}
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ol>
            </nav>
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();

        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const backdrop = document.getElementById('backdrop');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const sidebarHeader = document.getElementById('sidebar-header');
        const logoContainer = document.getElementById('logo-container');

        function toggleSidebar() {
            const isDesktop = window.innerWidth >= 1024;
            if (isDesktop) {
                sidebar.classList.toggle('w-64');
                sidebar.classList.toggle('w-20');
                sidebarHeader.classList.toggle('px-6');
                sidebarHeader.classList.toggle('justify-center');
                sidebarHeader.classList.toggle('px-0');
                logoContainer.classList.toggle('justify-start');
                logoContainer.classList.toggle('justify-center');
                mainContent.classList.toggle('lg:ml-64');
                mainContent.classList.toggle('lg:ml-20');
                sidebarTexts.forEach(text => {
                    if (text.classList.contains('hidden')) {
                        text.classList.remove('hidden');
                        setTimeout(() => text.classList.remove('opacity-0'), 50);
                    } else {
                        text.classList.add('opacity-0');
                        setTimeout(() => text.classList.add('hidden'), 200);
                    }
                });
            } else {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                    setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('opacity-0');
                    setTimeout(() => backdrop.classList.add('hidden'), 300);
                }
            }
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                backdrop.classList.add('hidden', 'opacity-0');
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('w-64');
                sidebar.classList.remove('w-20');
                mainContent.classList.add('lg:ml-64');
                mainContent.classList.remove('lg:ml-20');
                sidebarTexts.forEach(text => text.classList.remove('hidden', 'opacity-0'));
                sidebarHeader.classList.add('px-6');
                sidebarHeader.classList.remove('justify-center', 'px-0');
                logoContainer.classList.add('justify-start');
                logoContainer.classList.remove('justify-center');
                if (!sidebar.classList.contains('-translate-x-full')) sidebar.classList.add('-translate-x-full');
            }
        });

        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');


            arrow.classList.toggle('rotate-180');
        }


        const profileDropdown = document.getElementById('profile-dropdown');
        const userMenuButton = document.getElementById('user-menu-button');

        function toggleProfileMenu() {
            if (profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.remove('hidden');
                setTimeout(() => {
                    profileDropdown.classList.remove('opacity-0', 'scale-95');
                }, 10);
            } else {
                profileDropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    profileDropdown.classList.add('hidden');
                }, 200);
            }
        }
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    profileDropdown.classList.add('hidden');
                }, 200);
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
