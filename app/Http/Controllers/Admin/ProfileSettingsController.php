<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdiProfile;
use Illuminate\Support\Facades\Storage;

class ProfileSettingsController extends Controller
{
    public function index()
    {
        $profile = ProdiProfile::first();
        if (!$profile) {
            $profile = ProdiProfile::create([
                'visi' => "Menjadi Program Studi unggulan yang melahirkan sarjana ilmu Al-Qur'an dan Tafsir yang moderat, inovatif, dan berdaya saing global pada tahun 2030.",
                'misi' => "<ul>\n<li>Menyelenggarakan pendidikan dan pengajaran ilmu Al-Qur'an dan Tafsir berbasis teknologi dan pendekatan interdisipliner.</li>\n<li>Mengembangkan penelitian unggulan di bidang ilmu Al-Qur'an dan Tafsir yang responsif terhadap isu-isu kontemporer.</li>\n<li>Melaksanakan pengabdian kepada masyarakat berbasis nilai-nilai Al-Qur'an untuk pemberdayaan umat.</li>\n</ul>",
                'sejarah_singkat' => "<p>Program Studi Ilmu Al-Qur'an dan Tafsir didirikan untuk menjawab kebutuhan masyarakat akan sarjana yang ahli di bidang tafsir Al-Qur'an dan mampu beradaptasi dengan kemajuan teknologi modern.</p>",
            ]);
        }
        return view('admin.profile-settings.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi'            => 'required|string',
            'misi'            => 'required|string',
            'sejarah_singkat' => 'required|string',
            'jadwal_file'     => 'nullable|file|mimes:pdf|max:10240', // 10MB max PDF
        ]);

        $profile = ProdiProfile::first();
        if (!$profile) {
            $profile = new ProdiProfile();
        }

        $profile->visi = $request->visi;
        $profile->misi = $request->misi;
        $profile->sejarah_singkat = $request->sejarah_singkat;

        if ($request->hasFile('jadwal_file')) {
            if ($profile->jadwal_file && Storage::disk('public')->exists($profile->jadwal_file)) {
                Storage::disk('public')->delete($profile->jadwal_file);
            }
            $profile->jadwal_file = $request->file('jadwal_file')->store('documents', 'public');
        }

        $profile->save();

        return redirect()->back()->with('success', 'Konten profil dan jadwal kuliah berhasil diperbarui.');
    }
}
