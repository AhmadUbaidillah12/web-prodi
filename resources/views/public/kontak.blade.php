@extends('layouts.app')
@section('title', 'Kontak | Program Studi IAT')
@section('content')
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-heading font-bold text-secondary-dark mb-12 text-center">Hubungi Kami</h1>
        
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Informasi Kontak -->
            <div class="bg-bg-light p-8 rounded-2xl border border-gray-100">
                <h2 class="text-2xl font-heading font-bold mb-6 text-primary">Informasi Kontak</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary shadow-sm mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-secondary-dark text-lg">Alamat</h3>
                            <p class="text-gray-600">Gedung Fakultas Ushuluddin Lt. 2<br>Jl. Pendidikan No. 123, Kota Studi 12345</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary shadow-sm mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-secondary-dark text-lg">Email</h3>
                            <p class="text-gray-600"><a href="mailto:info@prodi-iat.ac.id" class="hover:text-primary transition">info@prodi-iat.ac.id</a></p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary shadow-sm mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-secondary-dark text-lg">Telepon</h3>
                            <p class="text-gray-600">(021) 1234-5678</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="font-bold text-secondary-dark text-lg mb-2">Jam Operasional</h3>
                    <ul class="text-gray-600 space-y-1">
                        <li class="flex justify-between"><span>Senin - Jum'at:</span> <span>08:00 - 16:00 WIB</span></li>
                        <li class="flex justify-between"><span>Sabtu - Minggu:</span> <span>Tutup</span></li>
                    </ul>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-heading font-bold mb-6 text-secondary-dark">Kirim Pesan</h2>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition" placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition" placeholder="email@contoh.com">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition" placeholder="Subjek pesan">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <button type="button" class="w-full py-3 px-4 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition shadow-md">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
