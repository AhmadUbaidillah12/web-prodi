@extends('layouts.app')
@section('title', 'Akademik | Program Studi IAT')
@section('content')

<!-- Header Akademik -->
<div class="bg-secondary-dark text-white py-16 md:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-primary opacity-90 mix-blend-multiply"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">Informasi Akademik</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Panduan komprehensif mengenai kurikulum, jadwal perkuliahan, dan layanan unduh dokumen akademik.</p>
    </div>
</div>

<!-- Kurikulum Section (Interactive Tabs) -->
<section class="py-20 bg-white" x-data="{ activeSemester: 1 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Struktur Kurikulum</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full mb-6"></div>
            <p class="text-gray-600 max-w-3xl mx-auto">Kurikulum didesain untuk ditempuh dalam 8 semester (144 SKS) dengan proporsi seimbang antara teori dan praktik keilmuan Al-Qur'an.</p>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- Semester Tabs Navigation -->
            <div class="flex flex-wrap justify-center gap-2 mb-8 bg-gray-50 p-2 rounded-xl border border-gray-150">
                @for ($i = 1; $i <= 8; $i++)
                <button 
                    @click="activeSemester = {{ $i }}" 
                    :class="activeSemester === {{ $i }} ? 'bg-primary text-white shadow-md' : 'text-gray-600 hover:bg-gray-200'"
                    class="px-5 py-2.5 rounded-lg font-semibold transition duration-300 text-sm sm:text-base cursor-pointer focus:outline-none">
                    Semester {{ $i }}
                </button>
                @endfor
            </div>

            <!-- Tab Contents -->
            <div class="bg-bg-light border border-gray-100 rounded-2xl p-6 md:p-8 shadow-sm">
                @for ($i = 1; $i <= 8; $i++)
                @php
                    $semCourses = $kurikulum->where('semester', $i);
                    $totalSks = $semCourses->sum('sks');
                @endphp
                <div x-show="activeSemester === {{ $i }}" x-transition.opacity style="display: none;">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-250">
                        <h3 class="text-xl font-bold font-heading text-secondary-dark">Mata Kuliah Semester {{ $i }}</h3>
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-bold">Total: {{ $totalSks }} SKS</span>
                    </div>

                    <!-- Course List -->
                    <div class="space-y-4">
                        @forelse($semCourses as $mk)
                        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center group hover:border-accent transition duration-300">
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-xs font-mono bg-gray-100 text-gray-500 px-2 py-1 rounded">{{ $mk->kode_mk }}</span>
                                    <h4 class="font-bold text-lg text-secondary-dark group-hover:text-primary transition">{{ $mk->nama_mk }}</h4>
                                </div>
                                <p class="text-gray-500 text-sm">{{ $mk->jenis }}</p>
                            </div>
                            <div class="flex items-center mt-4 md:mt-0 gap-4">
                                <span class="font-bold text-lg text-secondary-dark">{{ $mk->sks }} SKS</span>
                                @if($mk->deskripsi)
                                <div class="relative" x-data="{ tooltip: false }">
                                    <button @mouseenter="tooltip = true" @mouseleave="tooltip = false" class="text-gray-400 hover:text-accent transition focus:outline-none">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    <div x-show="tooltip" x-transition class="absolute right-0 bottom-full mb-2 w-64 bg-secondary-dark text-white text-xs p-3 rounded-lg shadow-lg z-10" style="display: none;">
                                        {{ $mk->deskripsi }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 italic">
                            Belum ada mata kuliah yang terdata untuk Semester {{ $i }}.
                        </div>
                        @endforelse
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- Jadwal Kuliah Section (Day Filter) -->
<section class="py-20 bg-bg-light border-y border-gray-100" x-data="{ activeDay: 'Senin' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-secondary-dark mb-4">Jadwal Kuliah</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto font-medium">Jadwal tatap muka kuliah harian Program Studi IAT.</p>
            
            @if($jadwal_file)
            <div class="mt-4">
                <a href="{{ asset('storage/' . $jadwal_file) }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-bold rounded-xl transition shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Master Jadwal Kuliah (PDF)
                </a>
            </div>
            @endif
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Day Tabs -->
            <div class="flex justify-center border-b border-gray-200 mb-8 overflow-x-auto whitespace-nowrap">
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                <button 
                    @click="activeDay = '{{ $day }}'" 
                    :class="activeDay === '{{ $day }}' ? 'border-primary text-primary font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="w-1/5 py-4 px-1 text-center border-b-2 font-semibold text-sm sm:text-base cursor-pointer transition focus:outline-none">
                    {{ $day }}
                </button>
                @endforeach
            </div>

            <!-- Timeline/List Hybrid Cards -->
            <div class="space-y-6">
                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                @php $daySchedules = $jadwal->where('hari', $day); @endphp
                <div x-show="activeDay === '{{ $day }}'" x-transition.opacity class="space-y-6" style="display: none;">
                    
                    <div class="relative pl-8 md:pl-0">
                        @if($daySchedules->isNotEmpty())
                            <!-- Desktop Timeline Line -->
                            <div class="hidden md:block absolute left-[8.5rem] top-0 bottom-0 w-px bg-gray-200"></div>

                            @foreach($daySchedules as $jw)
                            <!-- Schedule Item -->
                            <div class="md:flex items-center justify-between mb-8 relative">
                                <!-- Time Badge -->
                                <div class="md:w-32 mb-4 md:mb-0 flex-shrink-0">
                                    <div class="bg-white border border-gray-250 text-secondary-dark font-bold py-2 px-4 rounded-lg shadow-sm text-center inline-block w-full text-sm">
                                        {{ $jw->jam_mulai }} - {{ $jw->jam_selesai }}
                                    </div>
                                </div>
                                
                                <!-- Timeline Dot (Desktop) -->
                                <div class="hidden md:flex absolute left-[8.5rem] transform -translate-x-1/2 w-4 h-4 rounded-full bg-primary border-4 border-white"></div>

                                <!-- Card Content -->
                                <div class="md:w-[calc(100%-10rem)] bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                                    <h4 class="font-bold font-heading text-lg text-secondary-dark mb-2">{{ $jw->nama_mk }}</h4>
                                    <div class="flex flex-col sm:flex-row gap-4 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            {{ $jw->dosen }}
                                        </div>
                                        <div class="flex items-center font-semibold text-primary">
                                            <svg class="w-4 h-4 mr-2 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            {{ $jw->ruangan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="bg-white p-8 rounded-2xl text-center border text-gray-500 italic">
                                Tidak ada jadwal perkuliahan untuk hari {{ $day }}.
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Download Center (Dokumen Akademik) -->
<section class="py-20 bg-white" x-data="{ searchQuery: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-secondary-dark rounded-3xl p-8 md:p-12 relative overflow-hidden shadow-xl max-w-5xl mx-auto">
            <div class="absolute top-0 right-0 -mt-16 -mr-16 text-white/5">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
            </div>
            
            <div class="relative z-10 space-y-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-6 border-b border-white/10">
                    <div class="text-center md:text-left text-white md:max-w-md">
                        <h2 class="text-3xl font-heading font-bold mb-2">Pusat Unduh Dokumen</h2>
                        <p class="text-gray-300 text-sm">Unduh panduan akademik, formulir pendaftaran, kalender akademik, dan dokumen penunjang lainnya.</p>
                    </div>
                    <!-- Search Input -->
                    <div class="w-full md:w-80">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input 
                                type="text" 
                                x-model="searchQuery" 
                                placeholder="Cari dokumen..." 
                                class="w-full pl-10 pr-4 py-3 bg-white/10 hover:bg-white/15 focus:bg-white text-white focus:text-secondary-dark placeholder-gray-400 focus:placeholder-gray-500 rounded-xl border border-white/20 focus:border-white transition-all text-sm outline-none">
                        </div>
                    </div>
                </div>

                <!-- Document Grid -->
                @if($documents->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($documents as $doc)
                    <div class="bg-white/5 hover:bg-white/10 backdrop-blur-sm border border-white/10 p-5 rounded-2xl flex items-start justify-between gap-4 text-white transition group doc-item"
                         x-show="searchQuery === '' || 
                                 '{{ strtolower($doc->nama_dokumen) }}'.includes(searchQuery.toLowerCase()) || 
                                 '{{ strtolower($doc->deskripsi) }}'.includes(searchQuery.toLowerCase())">
                        <div class="flex-grow space-y-1.5">
                            <div class="flex items-center gap-3">
                                <div class="bg-accent/20 p-2 rounded-lg text-accent flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="font-bold text-base line-clamp-1 text-gray-100 group-hover:text-white transition">{{ $doc->nama_dokumen }}</span>
                            </div>
                            @if($doc->deskripsi)
                                <p class="text-xs text-gray-400 line-clamp-2 pl-12 leading-relaxed">{{ $doc->deskripsi }}</p>
                            @endif
                        </div>
                        <a href="{{ asset('storage/' . $doc->file_path) }}" download class="flex-shrink-0 p-2 bg-white/10 hover:bg-primary text-gray-300 hover:text-white rounded-xl transition duration-300 shadow-sm" title="Unduh Berkas">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-400 bg-white/5 rounded-2xl border border-white/5">
                    Belum ada dokumen akademik yang diunggah admin.
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
