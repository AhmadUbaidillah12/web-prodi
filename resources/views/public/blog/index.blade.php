@extends('layouts.app')
@section('title', 'Blog & Kegiatan | Program Studi IAT')
@section('content')
<div class="bg-bg-light py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-heading font-bold text-secondary-dark mb-4">Blog & Kegiatan</h1>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">Kumpulan artikel, berita, dan dokumentasi kegiatan dari Program Studi Ilmu Al-Qur'an dan Tafsir.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
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
            <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded-xl shadow-sm border border-gray-100">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <p class="text-xl">Belum ada artikel yang dipublikasikan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
