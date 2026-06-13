<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Warkop Kong Alim</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar Backdrop for Mobile -->
    <div id="sidebar-backdrop" class="fixed inset-0 z-30 bg-slate-900/50 hidden md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-white flex-shrink-0 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
        <div class="p-6 flex items-center justify-between">
            <h1 class="text-xl font-bold tracking-wider text-orange-400">ADMIN WARKOP</h1>
            <button id="close-sidebar-button" class="text-slate-400 hover:text-white focus:outline-none md:hidden">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ Request::is('admin/dashboard') ? 'bg-slate-800 text-orange-400' : '' }}">
                <i class="fas fa-home w-6"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ Request::is('admin/categories*') ? 'bg-slate-800 text-orange-400' : '' }}">
                <i class="fas fa-tags w-6"></i> Kategori Menu
            </a>
            <a href="{{ route('admin.menus.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ Request::is('admin/menus*') ? 'bg-slate-800 text-orange-400' : '' }}">
                <i class="fas fa-utensils w-6"></i> Menu Warkop
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ Request::is('admin/contacts*') ? 'bg-slate-800 text-orange-400' : '' }}">
                <i class="fas fa-envelope w-6"></i> Pesan Kontak
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ Request::is('admin/settings*') ? 'bg-slate-800 text-orange-400' : '' }}">
                <i class="fas fa-cog w-6"></i> Pengaturan
            </a>
            <div class="pt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 rounded-lg text-red-400 hover:bg-slate-800 transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i> Logout
                    </button>
                </form>
            </div>
        </nav>
        <div class="p-6 text-xs text-slate-500">
            &copy; 2026 Warkop Kong Alim
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-4 md:px-8">
            <div class="flex items-center space-x-4">
                <!-- Hamburger Button -->
                <button id="hamburger-button" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" target="_blank" class="text-sm text-gray-500 hover:text-orange-500">
                    <i class="fas fa-external-link-alt"></i> Lihat Website
                </a>
                <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold border border-orange-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Scrollable Area -->
        <div class="p-8 overflow-y-auto">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerButton = document.getElementById('hamburger-button');
            const closeSidebarButton = document.getElementById('close-sidebar-button');
            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebar-backdrop');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarBackdrop.classList.toggle('hidden');
            }

            if (hamburgerButton) {
                hamburgerButton.addEventListener('click', toggleSidebar);
            }
            if (closeSidebarButton) {
                closeSidebarButton.addEventListener('click', toggleSidebar);
            }
            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', toggleSidebar);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
