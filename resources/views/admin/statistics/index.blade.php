@extends('layouts.admin')

@section('title', 'Update Angka Statistik - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-heading font-bold text-secondary-dark">Update Angka Statistik</h1>
            <p class="text-sm text-gray-500">Sesuaikan angka-angka indikator utama prodi yang tampil di halaman beranda.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8">
        <form action="{{ route('admin.statistics.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Mahasiswa -->
                <div>
                    <label for="total_mahasiswa" class="block text-sm font-semibold text-gray-700 mb-2">Total Mahasiswa</label>
                    <input type="number" name="total_mahasiswa" id="total_mahasiswa" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('total_mahasiswa') border-red-500 @enderror"
                           value="{{ old('total_mahasiswa', $statistics->total_mahasiswa ?? 0) }}" required min="0">
                    @error('total_mahasiswa')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Alumni -->
                <div>
                    <label for="jumlah_alumni" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Alumni Aktif</label>
                    <input type="number" name="jumlah_alumni" id="jumlah_alumni" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('jumlah_alumni') border-red-500 @enderror"
                           value="{{ old('jumlah_alumni', $statistics->jumlah_alumni ?? 0) }}" required min="0">
                    @error('jumlah_alumni')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jurnal Terpublikasi -->
                <div>
                    <label for="jurnal_terpublikasi" class="block text-sm font-semibold text-gray-700 mb-2">Jurnal Publikasi</label>
                    <input type="number" name="jurnal_terpublikasi" id="jurnal_terpublikasi" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition @error('jurnal_terpublikasi') border-red-500 @enderror"
                           value="{{ old('jurnal_terpublikasi', $statistics->jurnal_terpublikasi ?? 0) }}" required min="0">
                    @error('jurnal_terpublikasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
