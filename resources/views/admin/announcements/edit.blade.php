@extends('layouts.admin')

@section('title', 'Edit Pengumuman - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Edit Pengumuman</h1>
        <p class="text-gray-600">Perbarui informasi atau pengumuman yang sudah dipublikasikan.</p>
    </div>
    <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-3xl">
    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengumuman</label>
                <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('title') border-red-500 @enderror" placeholder="Masukkan judul pengumuman...">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar / Banner Pengumuman (Opsional)</label>
                <div class="flex items-center gap-4">
                    <div class="w-24 h-16 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-400 overflow-hidden flex-shrink-0" id="preview-box">
                        @if($announcement->image)
                            <img src="{{ asset('storage/' . $announcement->image) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-[#800000] hover:file:bg-gray-100 file:cursor-pointer @error('image') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-2">Pilih file baru jika ingin mengganti gambar banner. Format: JPEG, PNG, JPG, GIF, SVG. Ukuran Maks: 2MB.</p>
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengumuman</label>
                <textarea name="content" id="content" rows="6" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('content') border-red-500 @enderror" placeholder="Tulis rincian pengumuman di sini...">{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }} class="w-4.5 h-4.5 text-primary border-gray-300 rounded focus:ring-primary">
                <label for="is_active" class="ml-2 block text-sm font-semibold text-gray-700">Tampilkan / Aktifkan Pengumuman ini</label>
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.announcements.index') }}" class="px-5 py-3 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-semibold transition text-center">Batal</a>
            <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm">Perbarui Pengumuman</button>
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
