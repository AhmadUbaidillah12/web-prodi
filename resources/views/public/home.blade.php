@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-secondary-dark text-white py-24 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-primary opacity-90 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-[url('https://pmb.uicordoba.ac.id/img/mtk.webp')] bg-cover bg-center mix-blend-overlay opacity-20"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center md:text-left">
        <div class="max-w-3xl">
            <span class="inline-block py-1 px-3 rounded-full bg-accent/20 text-accent font-semibold text-sm mb-6 border border-accent/30">Program Studi Unggulan</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6 leading-tight">Membentuk Generasi <span class="text-accent">Qur'ani</span> & Berwawasan Global</h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed max-w-2xl">Selamat datang di Program Studi Ilmu Al-Qur'an dan Tafsir. Tempat di mana tradisi keilmuan Islam bertemu dengan tantangan modernitas.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('blog.index') }}" class="px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-lg font-semibold transition shadow-lg hover:shadow-xl text-center">Lihat Kegiatan Kami</a>
                <a href="{{ route('profil') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white rounded-lg font-semibold transition backdrop-blur-sm border border-white/20 text-center">Profil Prodi</a>
            </div>
        </div>
    </div>
</section>

<!-- Statistik Prodi (Counter) -->
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-200">
            <div class="p-4 transform hover:-translate-y-1 transition duration-300">
                <div class="text-5xl font-heading font-bold text-primary mb-2">{{ $stats->total_mahasiswa ?? 450 }}+</div>
                <div class="text-gray-500 font-medium uppercase tracking-wider text-sm">Total Mahasiswa</div>
            </div>
            <div class="p-4 transform hover:-translate-y-1 transition duration-300">
                <div class="text-5xl font-heading font-bold text-primary mb-2">{{ $stats->jumlah_alumni ?? 1200 }}+</div>
                <div class="text-gray-500 font-medium uppercase tracking-wider text-sm">Alumni Aktif</div>
            </div>
            <div class="p-4 transform hover:-translate-y-1 transition duration-300">
                <div class="text-5xl font-heading font-bold text-primary mb-2">{{ $stats->jurnal_terpublikasi ?? 320 }}+</div>
                <div class="text-gray-500 font-medium uppercase tracking-wider text-sm">Jurnal Publikasi</div>
            </div>
        </div>
    </div>
</section>

<!-- Highlight Kegiatan Terbaru (Blog Grid) -->
<section class="py-20 bg-bg-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Highlight Kegiatan</h2>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Berita, artikel, dan kegiatan terbaru dari civitas akademika Program Studi Ilmu Al-Qur'an dan Tafsir.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($highlights as $post)
            <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full border border-gray-100">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $post->image ? (Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-accent text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $post->category->name ?? 'Umum' }}</span>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-sm text-gray-500 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $post->created_at->format('d M Y') }}
                    </div>
                    <h3 class="text-xl font-bold font-heading mb-3 line-clamp-2 hover:text-primary transition">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3 text-sm flex-grow">{{ strip_tags($post->content) }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-primary font-medium hover:text-primary-dark transition inline-flex items-center mt-auto">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                <p>Belum ada kegiatan yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('blog.index') }}"
               class="inline-flex items-center gap-2 px-8 py-3 rounded-xl border-2 font-semibold text-sm transition-all duration-300 hover:bg-primary hover:text-white group"
               style="border-color:#800000; color:#800000;">
                Lihat Semua Kegiatan
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Video Profil Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Kenali Kami Lebih Dekat</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
        </div>

        <div class="max-w-5xl mx-auto" x-data="{ videoOpen: false }">
            <!-- Thumbnail & Play Button -->
            <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl group cursor-pointer" @click="videoOpen = true">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1200&q=80" alt="Video Thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition duration-300 flex items-center justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-accent rounded-full animate-ping opacity-75"></div>
                        <div class="relative bg-accent text-white w-20 h-20 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-110 transition duration-300">
                            <svg class="w-10 h-10 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Modal -->
            <div x-show="videoOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" style="display: none;">
                <div class="relative w-full max-w-5xl aspect-video bg-black rounded-xl overflow-hidden shadow-2xl" @click.away="videoOpen = false">
                    <button @click="videoOpen = false" class="absolute -top-10 right-0 text-white hover:text-accent transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <template x-if="videoOpen">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" title="Video Profil" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </template>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events (Agenda Mendatang) & Pengumuman -->
<section class="py-20 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Pengumuman Terbaru</h2>
                <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="space-y-6">
                @forelse($announcements as $announcement)
                <div class="flex flex-col md:flex-row bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden group">
                    @if($announcement->image)
                    <div class="md:w-56 h-48 md:h-auto overflow-hidden bg-gray-50 flex-shrink-0">
                        <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    @else
                    <div class="md:w-56 h-48 md:h-auto bg-[#800000]/5 flex items-center justify-center text-[#800000] flex-shrink-0">
                        <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col justify-center">
                        <div class="text-xs text-accent font-semibold mb-2 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $announcement->created_at->format('d M Y') }}
                        </div>
                        <h3 class="text-xl font-bold font-heading mb-2 text-secondary-dark hover:text-primary transition">{{ $announcement->title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit(strip_tags($announcement->content), 150) }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-100">
                    <p>Belum ada pengumuman terbaru saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Galeri Kegiatan Mahasiswa (Marquee) -->
<section class="py-16 bg-bg-light overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10 text-center">
        <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Galeri Kegiatan Mahasiswa</h2>
        <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
    </div>

    <!-- Marquee Container -->
    <div class="relative flex overflow-x-hidden group">
        <!-- Track 1 -->
        <div class="flex animate-marquee whitespace-nowrap group-hover:[animation-play-state:paused]">
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1523580494112-071d16944118?auto=format&fit=crop&w=600&q=80" alt="Malam Keakraban" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Malam Keakraban</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=600&q=80" alt="Kajian Tafsir" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Kajian Tafsir Terapan</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1511632765486-a01c80cb40c7?auto=format&fit=crop&w=600&q=80" alt="Praktikum" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Praktikum Laboratorium</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=600&q=80" alt="Diskusi Ilmiah" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Diskusi Ilmiah</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80" alt="Pelepasan Wisudawan" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Pelepasan Wisudawan</h3></div></div></div>
        </div>
        <!-- Track 2 (Clone for infinite effect) -->
        <div class="flex animate-marquee whitespace-nowrap group-hover:[animation-play-state:paused] absolute top-0" style="left: 100%;">
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1523580494112-071d16944118?auto=format&fit=crop&w=600&q=80" alt="Malam Keakraban" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Malam Keakraban</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=600&q=80" alt="Kajian Tafsir" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Kajian Tafsir Terapan</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1511632765486-a01c80cb40c7?auto=format&fit=crop&w=600&q=80" alt="Praktikum" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Praktikum Laboratorium</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=600&q=80" alt="Diskusi Ilmiah" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Diskusi Ilmiah</h3></div></div></div>
            <div class="px-4"><div class="relative w-80 h-64 md:h-72 rounded-2xl overflow-hidden shadow-md group-hover:shadow-lg transition"><img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80" alt="Pelepasan Wisudawan" class="w-full h-full object-cover"><div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-6"><h3 class="text-white font-bold text-lg">Pelepasan Wisudawan</h3></div></div></div>
        </div>
    </div>
</section>

@endsection
