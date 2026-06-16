@extends('layouts.admin')

@section('title', 'Kelola Akademik & Jadwal - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ tab: 'kurikulum', activeEditKurikulum: null, activeEditJadwal: null }">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-heading font-bold text-secondary-dark">Kelola Akademik &amp; Jadwal</h1>
            <p class="text-sm text-gray-500">Kelola mata kuliah per semester dan jadwal perkuliahan harian.</p>
        </div>
        <div class="flex bg-gray-100 p-1.5 rounded-xl border border-gray-200">
            <button @click="tab = 'kurikulum'" :class="tab === 'kurikulum' ? 'bg-white text-primary shadow-sm' : 'text-gray-600 hover:text-gray-900'" class="px-4 py-2 text-sm font-bold rounded-lg transition duration-200">
                Struktur Kurikulum
            </button>
            <button @click="tab = 'jadwal'" :class="tab === 'jadwal' ? 'bg-white text-primary shadow-sm' : 'text-gray-600 hover:text-gray-900'" class="px-4 py-2 text-sm font-bold rounded-lg transition duration-200">
                Jadwal Perkuliahan
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- ===================================
         TAB: STRUKTUR KURIKULUM
         =================================== --}}
    <div x-show="tab === 'kurikulum'" x-transition.opacity class="space-y-8">
        <!-- Add Course Form -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h2 class="text-lg font-heading font-bold text-secondary-dark mb-4">Tambah Mata Kuliah Baru</h2>
            <form action="{{ route('admin.academic.kurikulum.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Semester</label>
                    <select name="semester" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        @for($s=1; $s<=8; $s++)
                            <option value="{{ $s }}">Semester {{ $s }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kode MK</label>
                    <input type="text" name="kode_mk" placeholder="Contoh: IAT101" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" placeholder="Nama Mata Kuliah" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">SKS</label>
                    <input type="number" name="sks" min="1" max="10" value="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Jenis MK</label>
                    <input type="text" name="jenis" placeholder="Contoh: Wajib Prodi" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi Ringkas (Optional)</label>
                    <input type="text" name="deskripsi" placeholder="Deskripsi materi mata kuliah..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-bold text-sm transition">
                        + Tambah Mata Kuliah
                    </button>
                </div>
            </form>
        </div>

        <!-- Curriculum List -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base font-bold text-secondary-dark">Daftar Mata Kuliah per Semester</h3>
            </div>
            @if($kurikulum->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    Belum ada mata kuliah kurikulum.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-xs text-gray-700 uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3">Sem</th>
                                <th class="px-6 py-3">Kode</th>
                                <th class="px-6 py-3">Nama Mata Kuliah</th>
                                <th class="px-6 py-3">SKS</th>
                                <th class="px-6 py-3">Jenis</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150">
                            @foreach($kurikulum as $mk)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-secondary-dark">S{{ $mk->semester }}</td>
                                <td class="px-6 py-4 font-mono text-xs">{{ $mk->kode_mk }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-secondary-dark">{{ $mk->nama_mk }}</div>
                                    @if($mk->deskripsi)
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $mk->deskripsi }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold">{{ $mk->sks }} SKS</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs rounded-full bg-primary/10 text-primary font-semibold">{{ $mk->jenis }}</span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <button @click="activeEditKurikulum = {{ json_encode($mk) }}" class="p-1.5 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('admin.academic.kurikulum.destroy', $mk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Curriculum Edit Modal --}}
        <div x-show="activeEditKurikulum" class="fixed inset-0 z-50 flex items-center justify-center bg-black/55 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-2xl w-full max-w-xl p-6 shadow-2xl border border-gray-100" @click.away="activeEditKurikulum = null">
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <h3 class="text-lg font-bold text-secondary-dark font-heading">Edit Mata Kuliah</h3>
                    <button @click="activeEditKurikulum = null" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <template x-if="activeEditKurikulum">
                    <form :action="`{{ url('/admin/academic/kurikulum') }}/${activeEditKurikulum.id}`" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Semester</label>
                                <select name="semester" :value="activeEditKurikulum.semester" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                                    @for($s=1; $s<=8; $s++)
                                        <option value="{{ $s }}">Semester {{ $s }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Kode MK</label>
                                <input type="text" name="kode_mk" :value="activeEditKurikulum.kode_mk" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" :value="activeEditKurikulum.nama_mk" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">SKS</label>
                                <input type="number" name="sks" :value="activeEditKurikulum.sks" min="1" max="10" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Jenis</label>
                                <input type="text" name="jenis" :value="activeEditKurikulum.jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi Ringkas</label>
                            <textarea name="deskripsi" :value="activeEditKurikulum.deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
                        </div>
                        <div class="pt-4 border-t flex justify-end gap-2">
                            <button type="button" @click="activeEditKurikulum = null" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-bold text-sm text-gray-600 transition">Batal</button>
                            <button type="submit" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-bold text-sm transition">Simpan Perubahan</button>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>

    {{-- ===================================
         TAB: JADWAL PERKULIAHAN
         =================================== --}}
    <div x-show="tab === 'jadwal'" x-transition.opacity class="space-y-8" style="display: none;">
        <!-- Add Schedule Form -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h2 class="text-lg font-heading font-bold text-secondary-dark mb-4">Tambah Jadwal Baru</h2>
            <form action="{{ route('admin.academic.jadwal.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Hari</label>
                    <select name="hari" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Jam Mulai</label>
                    <input type="text" name="jam_mulai" placeholder="Contoh: 08:00" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Jam Selesai</label>
                    <input type="text" name="jam_selesai" placeholder="Contoh: 09:40" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mk" placeholder="Mata Kuliah" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Dosen Pengampu</label>
                    <input type="text" name="dosen" placeholder="Nama Dosen beserta Gelar" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Ruangan</label>
                    <input type="text" name="ruangan" placeholder="Contoh: Ruang A.201" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-bold text-sm transition">
                        + Tambah Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Schedule List -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base font-bold text-secondary-dark">Daftar Jadwal Harian</h3>
            </div>
            @if($jadwal->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    Belum ada jadwal perkuliahan.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-xs text-gray-700 uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3">Hari</th>
                                <th class="px-6 py-3">Jam</th>
                                <th class="px-6 py-3">Mata Kuliah</th>
                                <th class="px-6 py-3">Dosen</th>
                                <th class="px-6 py-3">Ruangan</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-150">
                            @foreach($jadwal as $jw)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-secondary-dark">{{ $jw->hari }}</td>
                                <td class="px-6 py-4 font-semibold text-[#800000]">{{ $jw->jam_mulai }} - {{ $jw->jam_selesai }}</td>
                                <td class="px-6 py-4 font-bold text-secondary-dark">{{ $jw->nama_mk }}</td>
                                <td class="px-6 py-4">{{ $jw->dosen }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded border border-gray-200 font-medium">{{ $jw->ruangan }}</span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <button @click="activeEditJadwal = {{ json_encode($jw) }}" class="p-1.5 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('admin.academic.jadwal.destroy', $jw->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Schedule Edit Modal --}}
        <div x-show="activeEditJadwal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/55 backdrop-blur-sm p-4" style="display: none;">
            <div class="bg-white rounded-2xl w-full max-w-xl p-6 shadow-2xl border border-gray-100" @click.away="activeEditJadwal = null">
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <h3 class="text-lg font-bold text-secondary-dark font-heading">Edit Jadwal Kuliah</h3>
                    <button @click="activeEditJadwal = null" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <template x-if="activeEditJadwal">
                    <form :action="`{{ url('/admin/academic/jadwal') }}/${activeEditJadwal.id}`" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Hari</label>
                                <select name="hari" :value="activeEditJadwal.hari" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Jam Mulai</label>
                                <input type="text" name="jam_mulai" :value="activeEditJadwal.jam_mulai" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1">Jam Selesai</label>
                                <input type="text" name="jam_selesai" :value="activeEditJadwal.jam_selesai" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" :value="activeEditJadwal.nama_mk" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Dosen Pengampu</label>
                            <input type="text" name="dosen" :value="activeEditJadwal.dosen" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Ruangan</label>
                            <input type="text" name="ruangan" :value="activeEditJadwal.ruangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                        </div>
                        <div class="pt-4 border-t flex justify-end gap-2">
                            <button type="button" @click="activeEditJadwal = null" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-bold text-sm text-gray-600 transition">Batal</button>
                            <button type="submit" class="px-5 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg font-bold text-sm transition">Simpan Perubahan</button>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
