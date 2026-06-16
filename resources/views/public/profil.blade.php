@extends('layouts.app')
@section('title', 'Profil | Program Studi IAT')
@section('content')

<!-- Header Profil -->
<div class="bg-secondary-dark text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary opacity-90 mix-blend-multiply"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">Profil Program Studi</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Mengenal lebih dekat sejarah, visi, misi, tenaga pendidik, dan fasilitas unggulan Program Studi Ilmu Al-Qur'an dan Tafsir.</p>
    </div>
</div>

<!-- Sejarah Singkat -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Sejarah Singkat</h2>
                <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
            </div>
            <div class="text-gray-600 leading-relaxed text-lg prose max-w-none text-center">
                {!! $profile->sejarah_singkat ?? '<p>Program Studi Ilmu Al-Qur\'an dan Tafsir didirikan untuk menjawab kebutuhan masyarakat akan sarjana yang ahli di bidang tafsir Al-Qur\'an dan mampu beradaptasi dengan kemajuan teknologi modern.</p>' !!}
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi Cards -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Visi & Misi</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <!-- Visi Card -->
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm hover:shadow-xl border border-transparent hover:border-accent transition duration-300 group">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold font-heading text-secondary-dark mb-4">Visi</h3>
                <div class="text-gray-600 leading-relaxed text-lg prose">
                    {!! $profile->visi ?? "Menjadi Program Studi unggulan yang melahirkan sarjana ilmu Al-Qur'an dan Tafsir yang moderat, inovatif, dan berdaya saing global pada tahun 2030." !!}
                </div>
            </div>

            <!-- Misi Card -->
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm hover:shadow-xl border border-transparent hover:border-accent transition duration-300 group">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-2xl font-bold font-heading text-secondary-dark mb-4">Misi</h3>
                <div class="text-gray-600 leading-relaxed prose">
                    @if(isset($profile->misi))
                        {!! $profile->misi !!}
                    @else
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Menyelenggarakan pendidikan dan pengajaran ilmu Al-Qur'an dan Tafsir berbasis teknologi dan pendekatan interdisipliner.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Mengembangkan penelitian unggulan di bidang ilmu Al-Qur'an dan Tafsir yang responsif terhadap isu-isu kontemporer.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Melaksanakan pengabdian kepada masyarakat berbasis nilai-nilai Al-Qur'an untuk pemberdayaan umat.</span>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dosen & Staf (Lecturer Grid) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Dosen & Staf Pengajar</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Pakar dan akademisi berdedikasi tinggi dalam mengembangkan keilmuan Al-Qur'an dan Tafsir.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($staffs as $staff)
            <div class="bg-bg-light rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 group border border-gray-100">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $staff->photo ? (Str::startsWith($staff->photo, 'http') ? $staff->photo : asset('storage/' . $staff->photo)) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80' }}" alt="{{ $staff->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <!-- Hover Social Icons -->
                    <div class="absolute inset-0 bg-primary/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-accent hover:text-white transition transform hover:scale-110" title="Google Scholar">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 24a7 7 0 1 1 0-14 7 7 0 0 1 0 14zm0-12a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-7h-13a1.5 1.5 0 0 0-1.5 1.5v11a1.5 1.5 0 0 0 1.5 1.5h13a1.5 1.5 0 0 0 1.5-1.5v-11a1.5 1.5 0 0 0-1.5-1.5z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-accent hover:text-white transition transform hover:scale-110" title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <h3 class="font-bold text-lg text-secondary-dark mb-1">{{ $staff->name }}</h3>
                    <p class="text-accent font-semibold text-sm mb-2">{{ $staff->title }}</p>
                    <p class="text-gray-500 text-xs">Bidang Keahlian: Ilmu Tafsir</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8 text-gray-500">
                Data Dosen/Staf belum tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Fasilitas Prodi (Bento Grid) -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Fasilitas Unggulan</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Sarana dan prasarana modern untuk mendukung terciptanya lingkungan akademik yang berkualitas.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Perpustakaan (Spans 2 cols) -->
            <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1000&q=80" alt="Perpustakaan" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-secondary-dark/90 via-secondary-dark/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-accent transition">Perpustakaan Referensi</h3>
                    <p class="text-gray-300 text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300">Koleksi kitab tafsir klasik dan kontemporer terlengkap, jurnal internasional, dan e-book.</p>
                </div>
            </div>

            <!-- Ruang Kelas -->
            <div class="relative h-80 rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=600&q=80" alt="Ruang Kelas" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-accent transition">Kelas Multimedia</h3>
                </div>
            </div>

            <!-- Laboratorium -->
            <div class="relative h-80 rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80" alt="Laboratorium" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-secondary-dark/90 via-secondary-dark/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 group-hover:text-accent transition">Lab Komputer</h3>
                </div>
            </div>

            <!-- Ruang Diskusi (Spans 2 cols) -->
            <div class="md:col-span-2 relative h-80 rounded-3xl overflow-hidden group">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000&q=80" alt="Ruang Diskusi" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-accent transition">Co-Working Space Mahasiswa</h3>
                    <p class="text-gray-200 text-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300">Ruang diskusi interaktif yang nyaman dilengkapi dengan akses WiFi berkecepatan tinggi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
