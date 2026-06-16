@extends('layouts.admin')

@section('title', 'Kelola Pengumuman - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Kelola Pengumuman</h1>
        <p class="text-gray-600">Daftar pengumuman penting untuk mahasiswa dan umum.</p>
    </div>
    <a href="{{ route('admin.announcements.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm flex items-center gap-2" style="background-color: #800000;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Pengumuman
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
                    <th class="p-6">Gambar/Banner</th>
                    <th class="p-6">Judul Pengumuman</th>
                    <th class="p-6">Status</th>
                    <th class="p-6">Dibuat Tanggal</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($announcements as $announcement)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="w-20 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            @if($announcement->image)
                                <img src="{{ asset('storage/' . $announcement->image) }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="p-6">
                        <span class="font-semibold text-secondary-dark block line-clamp-1">{{ $announcement->title }}</span>
                        <span class="text-xs text-gray-400 block mt-0.5">{{ Str::limit(strip_tags($announcement->content), 80) }}</span>
                    </td>
                    <td class="p-6">
                        @if($announcement->is_active)
                        <span class="text-xs px-2.5 py-1 bg-green-50 text-green-700 border border-green-100 rounded-full font-semibold">Aktif</span>
                        @else
                        <span class="text-xs px-2.5 py-1 bg-red-50 text-red-700 border border-red-100 rounded-full font-semibold">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="p-6 text-sm text-gray-500">
                        {{ $announcement->created_at->format('d M Y') }}
                    </td>
                    <td class="p-6">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
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
                    <td colspan="5" class="p-12 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <p class="text-lg font-medium mb-1">Belum ada pengumuman</p>
                        <p class="text-sm text-gray-400">Silakan tambahkan pengumuman baru melalui tombol di atas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($announcements->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection
