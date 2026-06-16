<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KurikulumItem;
use App\Models\JadwalKuliah;

class AcademicController extends Controller
{
    public function index()
    {
        $kurikulum = KurikulumItem::orderBy('semester')->orderBy('kode_mk')->get();
        $jadwal = JadwalKuliah::orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.academic.index', compact('kurikulum', 'jadwal'));
    }

    public function storeKurikulum(Request $request)
    {
        $validated = $request->validate([
            'semester'  => 'required|integer|min:1|max:8',
            'kode_mk'   => 'required|string|max:50',
            'nama_mk'   => 'required|string|max:255',
            'sks'       => 'required|integer|min:1|max:10',
            'jenis'     => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        KurikulumItem::create($validated);

        return redirect()->route('admin.academic.index')->with('success', 'Mata kuliah kurikulum berhasil ditambahkan.');
    }

    public function updateKurikulum(Request $request, $id)
    {
        $validated = $request->validate([
            'semester'  => 'required|integer|min:1|max:8',
            'kode_mk'   => 'required|string|max:50',
            'nama_mk'   => 'required|string|max:255',
            'sks'       => 'required|integer|min:1|max:10',
            'jenis'     => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $item = KurikulumItem::findOrFail($id);
        $item->update($validated);

        return redirect()->route('admin.academic.index')->with('success', 'Mata kuliah kurikulum berhasil diperbarui.');
    }

    public function destroyKurikulum($id)
    {
        $item = KurikulumItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.academic.index')->with('success', 'Mata kuliah kurikulum berhasil dihapus.');
    }

    public function storeJadwal(Request $request)
    {
        $validated = $request->validate([
            'hari'        => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|string|max:10',
            'jam_selesai' => 'required|string|max:10',
            'nama_mk'     => 'required|string|max:255',
            'dosen'       => 'required|string|max:255',
            'ruangan'     => 'required|string|max:100',
        ]);

        JadwalKuliah::create($validated);

        return redirect()->route('admin.academic.index')->with('success', 'Jadwal kuliah berhasil ditambahkan.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'hari'        => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|string|max:10',
            'jam_selesai' => 'required|string|max:10',
            'nama_mk'     => 'required|string|max:255',
            'dosen'       => 'required|string|max:255',
            'ruangan'     => 'required|string|max:100',
        ]);

        $item = JadwalKuliah::findOrFail($id);
        $item->update($validated);

        return redirect()->route('admin.academic.index')->with('success', 'Jadwal kuliah berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        $item = JadwalKuliah::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.academic.index')->with('success', 'Jadwal kuliah berhasil dihapus.');
    }
}
