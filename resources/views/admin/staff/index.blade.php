@extends('layouts.admin')

@section('title', 'Data Dosen & Staf - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-heading font-bold text-secondary-dark mb-2">Data Dosen & Staf</h1>
        <p class="text-gray-600">Daftar dosen pengajar dan tenaga kependidikan program studi.</p>
    </div>
    <a href="{{ route('admin.staff.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-semibold transition shadow-sm flex items-center gap-2" style="background-color: #800000;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Dosen/Staf
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
                    <th class="p-6">Foto</th>
                    <th class="p-6">Nama Lengkap</th>
                    <th class="p-6">Gelar/Jabatan Akademik</th>
                    <th class="p-6">Jabatan Struktural</th>
                    <th class="p-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($staffs as $staff)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 border border-gray-200">
                            <img src="{{ $staff->photo ? asset('storage/' . $staff->photo) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80' }}" alt="{{ $staff->name }}" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="p-6">
                        <span class="font-semibold text-secondary-dark block">{{ $staff->name }}</span>
                    </td>
                    <td class="p-6 text-sm text-gray-600">
                        {{ $staff->title }}
                    </td>
                    <td class="p-6 text-sm text-gray-600">
                        {{ $staff->position }}
                    </td>
                    <td class="p-6">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen/staf ini?')">
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
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <p class="text-lg font-medium mb-1">Belum ada data dosen/staf</p>
                        <p class="text-sm text-gray-400">Silakan tambahkan data dosen/staf baru melalui tombol di atas.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($staffs->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        {{ $staffs->links() }}
    </div>
    @endif
</div>
@endsection
