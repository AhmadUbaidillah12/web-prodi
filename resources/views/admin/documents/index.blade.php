@extends('layouts.admin')

@section('title', 'Manajemen Dokumen Akademik - Admin Panel')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-heading font-bold text-secondary-dark">Manajemen Dokumen Akademik</h1>
            <p class="text-sm text-gray-500">Unggah dan kelola berkas panduan, KRS, atau jurnal dalam format PDF/Word untuk diunduh mahasiswa.</p>
        </div>
        <a href="{{ route('admin.documents.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-sm transition shadow-md">
            + Unggah Dokumen
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        @if($documents->isEmpty())
            <div class="p-12 text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <p class="text-lg font-bold">Belum ada dokumen</p>
                <p class="text-sm text-gray-400 mt-1">Silakan klik "+ Unggah Dokumen" untuk menambahkan berkas baru.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs text-gray-700 uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-4">Nama Dokumen</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4">File Path</th>
                            <th class="px-6 py-4">Tanggal Diunggah</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-150">
                        @foreach($documents as $doc)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-secondary-dark">{{ $doc->nama_dokumen }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ Str::limit($doc->deskripsi, 80) }}</td>
                            <td class="px-6 py-4 font-mono text-xs">
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="text-primary hover:underline flex items-center gap-1">
                                    <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    {{ basename($doc->file_path) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $doc->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-2">
                                <a href="{{ route('admin.documents.edit', $doc->id) }}" class="p-1.5 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
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
            <div class="p-4 border-t border-gray-150">
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
