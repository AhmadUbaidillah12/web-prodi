@extends('layouts.app')
@section('title', $post->title . ' | Program Studi IAT')

@push('styles')
<style>
    /* ── Page entry animation ── */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-entry { animation: fadeSlideUp .55s cubic-bezier(.22,1,.36,1) both; }
    .anim-entry-delay-1 { animation-delay: .10s; }
    .anim-entry-delay-2 { animation-delay: .20s; }
    .anim-entry-delay-3 { animation-delay: .30s; }

    /* ── Rich-text article body ── */
    .article-body { color: #374151; font-size: 1.0625rem; line-height: 1.875; }

    .article-body h2 {
        font-size: 1.5rem; font-weight: 700; color: #2C3E50;
        margin: 2.25rem 0 1rem;
        padding-left: .875rem;
        border-left: 4px solid #800000;
        line-height: 1.35;
    }
    .article-body h3 {
        font-size: 1.2rem; font-weight: 700; color: #2C3E50;
        margin: 1.75rem 0 .75rem;
        padding-left: .75rem;
        border-left: 3px solid #D4AF37;
    }
    .article-body p { margin-bottom: 1.4rem; }

    .article-body ul, .article-body ol {
        margin: 1rem 0 1.5rem 1.5rem;
    }
    .article-body ul { list-style: none; padding-left: 0; }
    .article-body ul li {
        padding-left: 1.5rem; position: relative; margin-bottom: .5rem;
    }
    .article-body ul li::before {
        content: ''; position: absolute; left: 0; top: .65em;
        width: 8px; height: 8px; border-radius: 50%;
        background: #800000;
    }
    .article-body ol { list-style: decimal; }
    .article-body ol li {
        padding-left: .25rem; margin-bottom: .5rem;
        color: #800000; font-weight: 600;
    }
    .article-body ol li span { color: #374151; font-weight: 400; }

    .article-body blockquote {
        border-left: 5px solid #D4AF37;
        background: #fffbf0;
        padding: 1.25rem 1.5rem;
        margin: 1.75rem 0;
        border-radius: 0 .75rem .75rem 0;
        font-style: italic;
        color: #4B5563;
        position: relative;
    }
    .article-body blockquote::before {
        content: '\201C';
        font-size: 4rem; color: #D4AF37; opacity:.3;
        position: absolute; top: -1rem; left: .75rem;
        font-family: Georgia, serif; line-height:1;
    }
    .article-body a { color: #800000; text-decoration: underline; }
    .article-body img {
        border-radius: 1rem; max-width: 100%;
        box-shadow: 0 4px 24px rgba(0,0,0,.10);
        margin: 1.5rem auto; display: block;
    }
    .article-body strong { color: #2C3E50; }

    /* ── Sidebar card hover ── */
    .sidebar-card:hover .sidebar-thumb { transform: scale(1.07); }
    .sidebar-card:hover .sidebar-title  { color: #800000; }

    /* ── Arrow slide on "Lihat Semua" ── */
    .cta-arrow { transition: transform .3s ease; display: inline-block; }
    .cta-link:hover .cta-arrow { transform: translateX(5px); }

    /* ── Social share hover colors ── */
    .share-wa:hover   { background: #25D366; color: #fff; }
    .share-tg:hover   { background: #229ED9; color: #fff; }
    .share-fb:hover   { background: #1877F2; color: #fff; }
    .share-li:hover   { background: #0A66C2; color: #fff; }

    /* ── Sticky sidebar ── */
    @media (min-width: 1024px) {
        .sidebar-sticky { position: sticky; top: 100px; }
    }

    /* ── Tag pill ── */
    .tag-pill {
        display: inline-flex; align-items: center;
        background: #F3F4F6; color: #4B5563;
        font-size: .8125rem; font-weight: 600;
        padding: .35rem .85rem; border-radius: 9999px;
        transition: all .3s ease; cursor: pointer;
    }
    .tag-pill:hover { background: #800000; color: #fff; }

    /* ── Category pill in sidebar ── */
    .cat-pill {
        display: inline-flex; align-items: center; justify-content: space-between;
        width: 100%;
        background: #F9FAFB; border: 1px solid #E5E7EB;
        color: #374151; font-size: .875rem; font-weight: 500;
        padding: .5rem 1rem; border-radius: .5rem;
        transition: all .3s ease;
    }
    .cat-pill:hover { background: #800000; color: #fff; border-color: #800000; }
    .cat-pill:hover .cat-count { background: rgba(255,255,255,.25); color:#fff; }
    .cat-count {
        background: #E5E7EB; color: #6B7280;
        font-size: .75rem; font-weight: 700;
        padding: .15rem .55rem; border-radius: 9999px;
        transition: all .3s ease;
    }
</style>
@endpush

@section('content')
<div class="bg-[#F8F9FA] min-h-screen py-10 lg:py-14">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ══════════════ BREADCRUMB ══════════════ --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8 anim-entry" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-[#800000] transition-colors duration-200">Beranda</a>
        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('blog.index') }}" class="hover:text-[#800000] transition-colors duration-200">Berita &amp; Kegiatan</a>
        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-[#800000] font-medium line-clamp-1 max-w-xs">{{ $post->title }}</span>
    </nav>

    {{-- ══════════════ MAIN GRID ══════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

        {{-- ─────────────────────────────────────────────
             LEFT COLUMN — MAIN ARTICLE CONTENT (8/12)
        ───────────────────────────────────────────── --}}
        <article class="lg:col-span-8 anim-entry anim-entry-delay-1">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- ── Category Badge + Title + Meta ── --}}
                <div class="px-8 pt-10 pb-6 md:px-12 md:pt-12">

                    {{-- Category Badge --}}
                    <div class="mb-4">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold tracking-wide"
                              style="background:rgba(128,0,0,.09); color:#800000;">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                            </svg>
                            {{ $post->category->name ?? 'Umum' }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl lg:text-4xl font-heading font-bold text-[#2C3E50] leading-tight mb-6">
                        {{ $post->title }}
                    </h1>

                    {{-- Author & Meta Row --}}
                    <div class="flex flex-wrap items-center gap-x-5 gap-y-3 pb-6 border-b border-gray-100">
                        {{-- Avatar + Author --}}
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm text-white flex-shrink-0"
                                 style="background: linear-gradient(135deg,#800000,#b30000);">
                                {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ $post->user->name ?? 'Admin Prodi' }}</span>
                        </div>
                        {{-- Date --}}
                        <div class="flex items-center gap-1.5 text-sm text-gray-500">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <time>{{ $post->created_at->translatedFormat('d F Y') }}</time>
                        </div>
                        {{-- Reading time --}}
                        <div class="flex items-center gap-1.5 text-sm text-gray-500">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $readingTime }} Menit Baca</span>
                        </div>
                        {{-- Views placeholder --}}
                        <div class="flex items-center gap-1.5 text-sm text-gray-500 ml-auto">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>Artikel Pilihan</span>
                        </div>
                    </div>
                </div>

                {{-- ── Hero / Feature Image ── --}}
                @if($post->image)
                <div class="px-8 md:px-12 pb-4">
                    <div class="aspect-video w-full overflow-hidden rounded-2xl shadow-md">
                        <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                             loading="lazy">
                    </div>
                </div>
                @endif

                {{-- ── Article Body ── --}}
                <div class="px-8 py-8 md:px-12 md:py-10">
                    <div class="article-body">
                        {!! $post->content !!}
                    </div>
                </div>

                {{-- ── Tags Cloud ── --}}
                <div class="px-8 md:px-12 pb-6">
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-3">Topik</p>
                    <div class="flex flex-wrap gap-2">
                        @if($post->category)
                        <span class="tag-pill">#{{ str_replace(' ', '', $post->category->name) }}</span>
                        @endif
                        <span class="tag-pill">#ProdiIAT</span>
                        <span class="tag-pill">#IlmuAlQuran</span>
                        <span class="tag-pill">#Tafsir</span>
                        <span class="tag-pill">#Kegiatan</span>
                    </div>
                </div>

                {{-- ── Social Share ── --}}
                <div class="px-8 md:px-12 pb-10 border-t border-gray-100 pt-8">
                    <p class="text-base font-bold text-[#2C3E50] mb-4">Bagikan Artikel Ini:</p>
                    <div class="flex flex-wrap gap-3">
                        {{-- WhatsApp --}}
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                           target="_blank" rel="noopener"
                           class="share-wa flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 font-semibold text-sm transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.121 1.532 5.847L.054 23.5l5.803-1.522A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.851 0-3.587-.502-5.077-1.38l-.364-.213-3.443.902.918-3.352-.236-.386A9.944 9.944 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                            </svg>
                            WhatsApp
                        </a>
                        {{-- Telegram --}}
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                           target="_blank" rel="noopener"
                           class="share-tg flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 font-semibold text-sm transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                            Telegram
                        </a>
                        {{-- Facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener"
                           class="share-fb flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 font-semibold text-sm transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        {{-- LinkedIn --}}
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                           target="_blank" rel="noopener"
                           class="share-li flex items-center gap-2 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 font-semibold text-sm transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>{{-- end article card --}}
        </article>

        {{-- ─────────────────────────────────────────────
             RIGHT COLUMN — STICKY SIDEBAR (4/12)
        ───────────────────────────────────────────── --}}
        <aside class="lg:col-span-4 anim-entry anim-entry-delay-2">
            <div class="sidebar-sticky space-y-6">

                {{-- ══ 3.1 Artikel Terkait / Terbaru ══ --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-6 rounded-full inline-block" style="background:#800000;"></span>
                        <h2 class="font-heading font-bold text-[#2C3E50] text-base">Artikel Terbaru</h2>
                    </div>
                    <div class="p-4 space-y-1">
                        @forelse($relatedPosts as $related)
                        <a href="{{ route('blog.show', $related->slug) }}"
                           class="sidebar-card flex items-start gap-3 p-3 rounded-xl hover:bg-[#F8F9FA] transition-all duration-300 group">
                            {{-- Thumbnail --}}
                            <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                                <img src="{{ $related->image ? (Str::startsWith($related->image, 'http') ? $related->image : asset('storage/' . $related->image)) : 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=200&q=80' }}"
                                     alt="{{ $related->title }}"
                                     class="sidebar-thumb w-full h-full object-cover transition-transform duration-300"
                                     loading="lazy">
                            </div>
                            {{-- Text --}}
                            <div class="flex-1 min-w-0 pt-0.5">
                                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:#800000;">
                                    {{ $related->category->name ?? 'Umum' }}
                                </span>
                                <p class="sidebar-title font-semibold text-sm text-gray-800 leading-snug line-clamp-2 transition-colors duration-300 mt-0.5">
                                    {{ $related->title }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $related->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg class="w-10 h-10 mx-auto mb-2 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm">Belum ada artikel lain.</p>
                        </div>
                        @endforelse
                    </div>
                    {{-- Lihat Semua CTA --}}
                    <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                        <a href="{{ route('blog.index') }}"
                           class="cta-link flex items-center gap-1.5 text-sm font-bold transition-colors duration-300 hover:opacity-80"
                           style="color:#800000;">
                            Lihat Semua Artikel
                            <span class="cta-arrow">→</span>
                        </a>
                    </div>
                </div>

                {{-- ══ 3.2 Kategori Populer ══ --}}
                @if($categories->count())
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-6 rounded-full inline-block" style="background:#D4AF37;"></span>
                        <h2 class="font-heading font-bold text-[#2C3E50] text-base">Kategori Populer</h2>
                    </div>
                    <div class="p-4 space-y-2">
                        @foreach($categories as $cat)
                        <a href="{{ route('blog.index') }}?category={{ $cat->slug ?? $cat->id }}"
                           class="cat-pill">
                            <span>{{ $cat->name }}</span>
                            <span class="cat-count">{{ $cat->posts_count }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ══ Quick Back Button ══ --}}
                <a href="{{ route('blog.index') }}"
                   class="flex items-center justify-center gap-2 w-full py-3 rounded-xl border-2 font-semibold text-sm transition-all duration-300 hover:bg-[#800000] hover:text-white hover:border-[#800000]"
                   style="border-color:#800000; color:#800000;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Artikel
                </a>

            </div>
        </aside>

    </div>{{-- end grid --}}
</div>{{-- end container --}}
</div>{{-- end page --}}
@endsection
