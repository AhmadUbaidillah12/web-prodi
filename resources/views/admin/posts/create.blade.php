@extends('layouts.admin')

@section('title', 'Tambah Artikel - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Tambah Artikel</h1>
        <p class="text-gray-600">Buat artikel, berita, atau dokumentasi kegiatan baru.</p>
    </div>
    <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('title') border-red-500 @enderror" placeholder="Masukkan judul artikel...">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="category_id" id="category_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('category_id') border-red-500 @enderror">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status Publikasi</label>
                <select name="status" id="status" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Unggulan (Featured Image)</label>
                <div class="flex items-center gap-4">
                    <div class="w-24 h-20 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-400 overflow-hidden" id="preview-box">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-[#800000] hover:file:bg-gray-100 file:cursor-pointer @error('image') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-2">Format: JPEG, PNG, JPG, GIF, SVG. Ukuran Maks: 2MB (2048 KB).</p>
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Artikel</label>
                <textarea name="content" id="content" rows="10" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('content') border-red-500 @enderror" placeholder="Tulis isi artikel di sini...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <button type="reset" class="px-5 py-3 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-semibold transition">Reset</button>
            <button type="submit" class="px-6 py-3 bg-[#800000] hover:bg-[#800000]/90 text-white rounded-xl font-semibold transition shadow-sm">Simpan Artikel</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const box = document.getElementById('preview-box');
                box.innerHTML = `<img src="${evt.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
