<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PublicController extends Controller
{
    public function home()
    {
        $highlights = Post::where('status', 'published')
            ->with('category')
            ->latest()
            ->take(4)
            ->get();
        $announcements = \App\Models\Announcement::where('is_active', true)
            ->latest()
            ->take(3)
            ->get();
        $stats = \App\Models\ProdiStatistic::first();
        return view('public.home', compact('highlights', 'announcements', 'stats'));
    }

    public function profil()
    {
        $staffs = \App\Models\Staff::all();
        $profile = \App\Models\ProdiProfile::first();
        return view('public.profil', compact('staffs', 'profile'));
    }

    public function akademik(Request $request)
    {
        $kurikulum = \App\Models\KurikulumItem::orderBy('semester')->orderBy('kode_mk')->get();
        $jadwal = \App\Models\JadwalKuliah::orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();
        
        $profile = \App\Models\ProdiProfile::first();
        $jadwal_file = $profile ? $profile->jadwal_file : null;

        $search = $request->query('q');
        $documents = \App\Models\DokumenAkademik::when($search, function ($query, $search) {
                return $query->where('nama_dokumen', 'like', '%' . $search . '%')
                             ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('public.akademik', compact('kurikulum', 'jadwal', 'jadwal_file', 'documents', 'search'));
    }

    public function blog()
    {
        $posts = Post::where('status', 'published')
            ->with('category')
            ->latest()
            ->paginate(9);
        return view('public.blog.index', compact('posts'));
    }

    public function blogShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'user'])
            ->firstOrFail();

        // Increment view count (optional, add views column if needed)
        // $post->increment('views');

        // Related / latest posts (excluding current)
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        // All categories with published post counts
        $categories = \App\Models\Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published');
        }])
        ->has('posts') // Hanya mengambil kategori yang memiliki relasi posts > 0
        ->orderByDesc('posts_count')
        ->get();

        // Reading time estimate (avg 200 words/min)
        $wordCount = str_word_count(strip_tags($post->content));
        $readingTime = max(1, ceil($wordCount / 200));

        return view('public.blog.show', compact('post', 'relatedPosts', 'categories', 'readingTime'));
    }

    public function kontak()
    {
        return view('public.kontak');
    }
}
