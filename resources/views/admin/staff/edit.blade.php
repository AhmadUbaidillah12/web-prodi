@extends('layouts.admin')

@section('title', 'Edit Dosen/Staf - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Edit Dosen/Staf</h1>
        <p class="text-gray-600">Perbarui profil dosen pengajar atau staf administrasi.</p>
    </div>
    <a href="{{ route('admin.staff.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-medium transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <form action="{{ route('admin.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('name') border-red-500 @enderror" placeholder="Contoh: Dr. H. Ahmad Tafsir, M.Ag.">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Gelar / Jabatan Akademik</label>
                <input type="text" name="title" id="title" value="{{ old('title', $staff->title) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('title') border-red-500 @enderror" placeholder="Contoh: Lektor Kepala / Ketua Program Studi">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan Struktural / Status</label>
                <input type="text" name="position" id="position" value="{{ old('position', $staff->position) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition @error('position') border-red-500 @enderror" placeholder="Contoh: Dosen Tetap / Sekretaris Prodi">
                @error('position')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 rounded-full bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-400 overflow-hidden flex-shrink-0" id="preview-box">
                        @if($staff->photo)
                            <img src="{{ asset('storage/' . $staff->photo) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <input type="file" name="photo" id="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-[#800000] hover:file:bg-gray-100 file:cursor-pointer @error('photo') border-red-500 @enderror">
                        <p class="text-xs text-gray-400 mt-2">Pilih file baru jika ingin mengganti foto. Format: JPEG, PNG, JPG, GIF, SVG. Ukuran Maks: 2MB.</p>
                    </div>
                </div>
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.staff.index') }}" class="px-5 py-3 border border-gray-200 text-gray-600 hover:bg-gray-50 rounded-xl font-semibold transition text-center">Batal</a>
            <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm">Perbarui Data</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('photo').addEventListener('change', function(e) {
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
