@extends('layouts.admin')

@section('title', 'Kategori - Admin Panel')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Kategori</h1>
    <p class="text-gray-600">Kelola kategori untuk pengelompokan artikel/blog.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-150 text-green-700 rounded-xl flex items-center gap-3">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <p class="font-medium">{{ session('success') }}</p>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Left Column: Categories List (8/12) -->
    <div class="lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold text-sm">
                        <th class="p-6">Nama Kategori</th>
                        <th class="p-6">Slug</th>
                        <th class="p-6">Jumlah Post</th>
                        <th class="p-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/50 transition" x-data="{ editing: false, categoryName: '{{ $category->name }}' }">
                        <td class="p-6">
                            <!-- View Mode -->
                            <div x-show="!editing" class="font-semibold text-secondary-dark">{{ $category->name }}</div>
                            <!-- Edit Mode Form -->
                            <div x-show="editing" style="display:none;" class="flex items-center gap-2">
                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="flex items-center gap-2 w-full">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" x-model="categoryName" required class="px-3 py-1.5 text-sm rounded-lg border border-gray-200 focus:outline-none focus:border-primary">
                                    <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-semibold">Simpan</button>
                                    <button type="button" @click="editing = false" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-xs font-semibold">Batal</button>
                                </form>
                            </div>
                        </td>
                        <td class="p-6 text-sm text-gray-500">
                            {{ $category->slug }}
                        </td>
                        <td class="p-6 text-sm text-gray-600 font-medium">
                            {{ $category->posts_count ?? 0 }} artikel
                        </td>
                        <td class="p-6">
                            <div class="flex items-center justify-center gap-3" x-show="!editing">
                                <button type="button" @click="editing = true" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua post dalam kategori ini juga akan terhapus.')">
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
                        <td colspan="4" class="p-12 text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            <p class="text-lg font-medium mb-1">Belum ada kategori</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $categories->links() }}
        </div>
        @endif
    </div>

    <!-- Right Column: Add Category Form (4/12) -->
    <div class="lg:col-span-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="font-bold text-secondary-dark text-lg mb-4">Tambah Kategori Baru</h3>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('name') border-red-500 @enderror" placeholder="Contoh: Berita Kemahasiswaan">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full py-3 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm">Tambah Kategori</button>
        </form>
    </div>
</div>
@endsection
