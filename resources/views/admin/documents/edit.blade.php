@extends('layouts.admin')

@section('title', 'Edit Dokumen Akademik - Admin Panel')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.documents.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-1.5 mb-2">
            &larr; Kembali ke Daftar Dokumen
        </a>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark">Edit Dokumen</h1>
        <p class="text-sm text-gray-500">Ubah detail atau perbarui berkas dokumen yang terunggah.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
        <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama Dokumen -->
            <div>
                <label for="nama_dokumen" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Dokumen</label>
                <input type="text" name="nama_dokumen" id="nama_dokumen" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition @error('nama_dokumen') border-red-500 @enderror"
                       value="{{ old('nama_dokumen', $document->nama_dokumen) }}" required>
                @error('nama_dokumen')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current File & File Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">File Saat Ini</label>
                <div class="mb-3 flex items-center gap-3 bg-gray-50 px-4 py-2.5 rounded-lg border border-gray-200 text-xs font-mono">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-primary hover:underline truncate max-w-xs">
                        {{ basename($document->file_path) }}
                    </a>
                </div>

                <label for="file_path" class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Berkas File (Optional)</label>
                <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">
                <p class="text-xs text-gray-400 mt-1.5">Biarkan kosong jika tidak ingin mengganti berkas. Maksimal 10 MB.</p>
                @error('file_path')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Ringkas (Optional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition @error('deskripsi') border-red-500 @enderror"
                          placeholder="Penjelasan singkat mengenai isi dokumen...">{{ old('deskripsi', $document->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t flex justify-end gap-3">
                <a href="{{ route('admin.documents.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl font-bold text-sm transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-sm transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
