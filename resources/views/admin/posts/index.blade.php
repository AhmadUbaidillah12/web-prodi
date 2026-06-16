@extends('layouts.admin')

@section('title', 'Kelola Post/Blog - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Kelola Post/Blog</h1>
        <p class="text-gray-600">Daftar artikel, berita, dan kegiatan program studi.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm flex items-center gap-2" style="background-color: #800000;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Artikel
    </a>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-150 text-green-700 rounded-xl flex items-center gap-3">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <p class="font-medium">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold text-sm">
                    <th class="p-6">Gambar</th>
                    <th class="p-6">Judul</th>
                    <th class="p-6">Kategori</th>
                    <th class="p-6">Status</th>
                    <th class="p-6">Tanggal Rilis</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=100&q=80' }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-6">
                        <span class="font-semibold text-secondary-dark block line-clamp-1">{{ $post->title }}</span>
                        <span class="text-xs text-gray-400 block mt-0.5">Oleh: {{ $post->user->name ?? 'Admin' }}</span>
                    </td>
                    <td class="p-6">
                        <span class="text-sm px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full font-medium">{{ $post->category->name ?? 'Umum' }}</span>
                    </td>
                    <td class="p-6">
                        @if($post->status === 'published')
                        <span class="text-xs px-2.5 py-1 bg-green-50 text-green-700 border border-green-100 rounded-full font-semibold">Published</span>
                        @else
                        <span class="text-xs px-2.5 py-1 bg-yellow-50 text-yellow-700 border border-yellow-100 rounded-full font-semibold">Draft</span>
                        @endif
                    </td>
                    <td class="p-6 text-sm text-gray-500">
                        {{ $post->created_at->format('d M Y') }}
                    </td>
                    <td class="p-6">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <p class="text-lg font-medium mb-1">Belum ada artikel</p>
                        <p class="text-sm text-gray-400">Silakan tambahkan artikel baru melalui tombol di atas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
