<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Prodi IAT')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-light font-body text-secondary-dark antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">
        
        <!-- Sidebar -->
        <aside class="bg-secondary-dark text-white w-full md:w-64 flex-shrink-0">
            <div class="h-20 flex items-center px-6 bg-primary-dark">
                <span class="text-xl font-heading font-bold text-white tracking-wide">Admin Panel</span>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-gray-300' }}">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.posts.*') ? 'bg-primary text-white' : 'text-gray-300' }}">Kelola Post/Blog</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-white' : 'text-gray-300' }}">Kategori</a>
                <a href="{{ route('admin.staff.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.staff.*') ? 'bg-primary text-white' : 'text-gray-300' }}">Data Dosen & Staf</a>
                <a href="{{ route('admin.announcements.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.announcements.*') ? 'bg-primary text-white' : 'text-gray-300' }}">Pengumuman</a>
                
                <div class="pt-4 border-t border-white/10 my-2">
                    <span class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">CMS Ekstensi</span>
                    <a href="{{ route('admin.profile.settings') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition text-sm {{ request()->routeIs('admin.profile.settings') ? 'bg-primary text-white' : 'text-gray-300' }}">Kelola Profil & Visi Misi</a>
                    <a href="{{ route('admin.academic.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition text-sm {{ request()->routeIs('admin.academic.index') ? 'bg-primary text-white' : 'text-gray-300' }}">Kelola Akademik & Jadwal</a>
                    <a href="{{ route('admin.documents.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition text-sm {{ request()->routeIs('admin.documents.*') ? 'bg-primary text-white' : 'text-gray-300' }}">Manajemen Dokumen</a>
                    <a href="{{ route('admin.statistics.index') }}" class="block px-4 py-2.5 rounded-lg hover:bg-white/10 transition text-sm {{ request()->routeIs('admin.statistics.index') ? 'bg-primary text-white' : 'text-gray-300' }}">Update Angka Statistik</a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-20 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 hover:text-primary focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin User' }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition font-medium">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6 flex-grow overflow-auto">
                @yield('content')
            </main>
            
            <footer class="bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Program Studi IAT. Admin Dashboard.
            </footer>
        </div>
    </div>
</body>
</html>
