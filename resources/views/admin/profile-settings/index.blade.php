@extends('layouts.admin')

@section('title', 'Kelola Profil & Visi Misi - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-heading font-bold text-secondary-dark">Kelola Profil &amp; Visi Misi</h1>
        <p class="text-sm text-gray-500">Sesuaikan deskripsi visi, misi, sejarah prodi, dan unggah berkas jadwal kuliah resmi.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
        <form action="{{ route('admin.profile.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Sejarah Singkat -->
            <div>
                <label for="sejarah_singkat" class="block text-sm font-semibold text-gray-700 mb-2">Sejarah Singkat (HTML/Text)</label>
                <textarea name="sejarah_singkat" id="sejarah_singkat" rows="6" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('sejarah_singkat') border-red-500 @enderror"
                          placeholder="Tuliskan sejarah singkat prodi..." required>{{ old('sejarah_singkat', $profile->sejarah_singkat ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Anda dapat menggunakan tag HTML dasar seperti &lt;p&gt; untuk paragraf.</p>
                @error('sejarah_singkat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Visi -->
            <div>
                <label for="visi" class="block text-sm font-semibold text-gray-700 mb-2">Visi Program Studi</label>
                <textarea name="visi" id="visi" rows="4" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('visi') border-red-500 @enderror"
                          placeholder="Visi program studi..." required>{{ old('visi', $profile->visi ?? '') }}</textarea>
                @error('visi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Misi -->
            <div>
                <label for="misi" class="block text-sm font-semibold text-gray-700 mb-2">Misi Program Studi (HTML/Format List)</label>
                <textarea name="misi" id="misi" rows="6" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('misi') border-red-500 @enderror"
                          placeholder="Contoh: <ul><li>Misi 1</li><li>Misi 2</li></ul>" required>{{ old('misi', $profile->misi ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Gunakan format list HTML (&lt;ul&gt;&lt;li&gt;Item&lt;/li&gt;&lt;/ul&gt;) untuk tampilan poin-poin yang rapi.</p>
                @error('misi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jadwal Kuliah Master PDF File -->
            <div class="p-5 bg-bg-light rounded-2xl border border-gray-200">
                <h3 class="text-base font-bold text-secondary-dark mb-3">Unggah File Jadwal Kuliah Mingguan (PDF)</h3>
                <div class="space-y-4">
                    @if($profile->jadwal_file)
                    <div class="flex items-center justify-between bg-white px-4 py-3 rounded-xl border border-gray-150">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-semibold text-gray-700 truncate max-w-xs">{{ basename($profile->jadwal_file) }}</span>
                        </div>
                        <a href="{{ asset('storage/' . $profile->jadwal_file) }}" target="_blank" class="text-sm text-primary hover:underline font-bold">Lihat File</a>
                    </div>
                    @else
                    <p class="text-sm text-gray-500 italic">Belum ada file jadwal kuliah master yang diunggah.</p>
                    @endif

                    <div>
                        <input type="file" name="jadwal_file" id="jadwal_file" accept=".pdf"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">Hanya file PDF dengan ukuran maksimal 10 MB.</p>
                        @error('jadwal_file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-150 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
