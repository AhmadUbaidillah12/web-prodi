<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DokumenAkademik;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = DokumenAkademik::latest()->paginate(15);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file_path'    => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'deskripsi'    => 'nullable|string',
        ]);

        $filePath = $request->file('file_path')->store('documents', 'public');

        DokumenAkademik::create([
            'nama_dokumen' => $request->nama_dokumen,
            'file_path'    => $filePath,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen akademik berhasil diunggah.');
    }

    public function edit($id)
    {
        $document = DokumenAkademik::findOrFail($id);
        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file_path'    => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB max
            'deskripsi'    => 'nullable|string',
        ]);

        $document = DokumenAkademik::findOrFail($id);
        $document->nama_dokumen = $request->nama_dokumen;
        $document->deskripsi = $request->deskripsi;

        if ($request->hasFile('file_path')) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $document->file_path = $request->file('file_path')->store('documents', 'public');
        }

        $document->save();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen akademik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $document = DokumenAkademik::findOrFail($id);
        
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen akademik berhasil dihapus.');
    }
}
