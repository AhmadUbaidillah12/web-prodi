@extends('layouts.admin')
@section('title', 'Dashboard - Admin Panel')
@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Dashboard</h1>
    <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan data hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center mr-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        </div>
        <div>
            <div class="text-sm text-gray-500 font-medium mb-1">Total Post/Blog</div>
            <div class="text-2xl font-bold text-secondary-dark">{{ $stats['posts'] ?? 0 }}</div>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-green-50 text-green-500 flex items-center justify-center mr-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
        <div>
            <div class="text-sm text-gray-500 font-medium mb-1">Kategori</div>
            <div class="text-2xl font-bold text-secondary-dark">{{ $stats['categories'] ?? 0 }}</div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-14 h-14 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center mr-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div>
            <div class="text-sm text-gray-500 font-medium mb-1">Dosen & Staf</div>
            <div class="text-2xl font-bold text-secondary-dark">{{ $stats['staff'] ?? 0 }}</div>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
        <h3 class="font-bold text-secondary-dark text-lg">Informasi Sistem</h3>
    </div>
    <div class="p-6">
        <p class="text-gray-600 mb-4">Gunakan menu di sebelah kiri untuk mengelola konten website. Fitur CRUD penuh (Create, Read, Update, Delete) tersedia untuk entitas-entitas berikut:</p>
        <ul class="list-disc list-inside space-y-2 text-gray-600">
            <li><strong>Kelola Post/Blog:</strong> Menambah artikel, berita, kegiatan, dan prestasi mahasiswa.</li>
            <li><strong>Kategori:</strong> Mengelompokkan artikel ke dalam topik yang relevan.</li>
            <li><strong>Data Dosen & Staf:</strong> Mengelola profil pengajar dan tenaga kependidikan.</li>
            <li><strong>Pengumuman:</strong> Mengatur informasi penting yang muncul di halaman beranda.</li>
        </ul>
        <div class="mt-6 p-4 bg-yellow-50 text-yellow-800 rounded-lg border border-yellow-100 text-sm flex items-start">
            <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p><strong>Catatan Pengembangan:</strong> Antarmuka CRUD saat ini disimulasikan sesuai dengan spesifikasi untuk memamerkan desain sistem admin. Pembuatan Controller CRUD penuh (create, store, edit, update, destroy) untuk setiap resource akan memakan waktu generasi yang lebih panjang, namun struktur databasenya sudah disiapkan.</p>
        </div>
    </div>
</div>
@endsection
