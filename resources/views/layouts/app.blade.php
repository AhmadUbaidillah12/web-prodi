<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Program Studi IAT')</title>
    <meta name="description" content="Website Resmi Program Studi Ilmu Al-Qur'an dan Tafsir">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="font-body text-secondary-dark bg-bg-light antialiased flex flex-col min-h-screen">

    <!-- Header Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-heading font-bold text-xl">
                            IAT
                        </div>
                        <span class="font-heading font-bold text-xl text-primary-dark">Prodi IAT</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-secondary hover:text-primary font-medium transition duration-150 {{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary' : '' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="text-secondary hover:text-primary font-medium transition duration-150 {{ request()->routeIs('profil') ? 'text-primary border-b-2 border-primary' : '' }}">Profil</a>
                    <a href="{{ route('akademik') }}" class="text-secondary hover:text-primary font-medium transition duration-150 {{ request()->routeIs('akademik') ? 'text-primary border-b-2 border-primary' : '' }}">Akademik</a>
                    <a href="{{ route('blog.index') }}" class="text-secondary hover:text-primary font-medium transition duration-150 {{ request()->routeIs('blog.*') ? 'text-primary border-b-2 border-primary' : '' }}">Blog & Kegiatan</a>
                    <a href="{{ route('kontak') }}" class="text-secondary hover:text-primary font-medium transition duration-150 {{ request()->routeIs('kontak') ? 'text-primary border-b-2 border-primary' : '' }}">Kontak</a>
                    <a href="https://pmb.uicordoba.ac.id/register" class="text-secondary hover:text-primary font-medium transition duration-150 'text-primary border-b-2 border-primary' : '' }}">Daftar</a>
                </nav>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-secondary hover:text-primary focus:outline-none" aria-controls="mobile-menu" aria-expanded="false" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-secondary hover:text-primary hover:bg-gray-50 rounded-md">Beranda</a>
                <a href="{{ route('profil') }}" class="block px-3 py-2 text-base font-medium text-secondary hover:text-primary hover:bg-gray-50 rounded-md">Profil</a>
                <a href="{{ route('akademik') }}" class="block px-3 py-2 text-base font-medium text-secondary hover:text-primary hover:bg-gray-50 rounded-md">Akademik</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-base font-medium text-secondary hover:text-primary hover:bg-gray-50 rounded-md">Blog & Kegiatan</a>
                <a href="{{ route('kontak') }}" class="block px-3 py-2 text-base font-medium text-secondary hover:text-primary hover:bg-gray-50 rounded-md">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary-dark text-white pt-12 pb-8 mt-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-heading font-bold mb-4 text-white">Program Studi IAT</h3>
                    <p class="text-gray-400 mb-4 leading-relaxed">Membangun generasi Qur'ani yang berwawasan luas dan berakhlak mulia melalui pendidikan ilmu Al-Qur'an dan Tafsir.</p>
                </div>
                <div>
                    <h3 class="text-xl font-heading font-bold mb-4 text-white">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('profil') }}" class="text-gray-400 hover:text-accent transition">Profil Prodi</a></li>
                        <li><a href="{{ route('akademik') }}" class="text-gray-400 hover:text-accent transition">Informasi Akademik</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-accent transition">Blog & Kegiatan</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-gray-400 hover:text-accent transition">Portal Admin</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-heading font-bold mb-4 text-white">Hubungi Kami</h3>
                    <address class="text-gray-400 not-italic leading-relaxed space-y-2">
                        <p>Jl. Pendidikan No. 123, Kota Studi</p>
                        <p>Email: <a href="mailto:info@prodi-iat.ac.id" class="hover:text-accent transition">info@prodi-iat.ac.id</a></p>
                        <p>Telp: (021) 1234-5678</p>
                    </address>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Program Studi Ilmu Al-Qur'an dan Tafsir. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
