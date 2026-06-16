<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdiStatistic;

class StatisticsController extends Controller
{
    public function index()
    {
        $statistics = ProdiStatistic::first();
        if (!$statistics) {
            $statistics = ProdiStatistic::create([
                'total_mahasiswa' => 450,
                'jumlah_alumni' => 1200,
                'jurnal_terpublikasi' => 320,
            ]);
        }
        return view('admin.statistics.index', compact('statistics'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'total_mahasiswa' => 'required|integer|min:0',
            'jumlah_alumni' => 'required|integer|min:0',
            'jurnal_terpublikasi' => 'required|integer|min:0',
        ]);

        $statistics = ProdiStatistic::first();
        if (!$statistics) {
            $statistics = new ProdiStatistic();
        }

        $statistics->fill($request->all());
        $statistics->save();

        return redirect()->back()->with('success', 'Angka statistik prodi berhasil diperbarui.');
    }
}
