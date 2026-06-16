<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Super Administrator',
            'username' => 'admin',
            'email' => 'iat@uicordoba.ac.id',
            'password' => bcrypt('password'),
            'role' => 'superadmin',
        ]);

        // Categories
        $cat1 = Category::create(['name' => 'Berita Akademik', 'slug' => 'berita-akademik']);
        $cat2 = Category::create(['name' => 'Prestasi Mahasiswa', 'slug' => 'prestasi-mahasiswa']);
        $cat3 = Category::create(['name' => 'Pengabdian Masyarakat', 'slug' => 'pengabdian-masyarakat']);

        // Posts
        Post::create([
            'title' => 'Mahasiswa IAT Meraih Juara 1 MTQ Nasional',
            'slug' => 'mahasiswa-iat-juara-1-mtq-nasional',
            'content' => '<p>Prestasi membanggakan kembali ditorehkan oleh mahasiswa Program Studi Ilmu Al-Qur\'an dan Tafsir...</p>',
            'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80',
            'category_id' => $cat2->id,
            'user_id' => $admin->id,
            'status' => 'published',
        ]);

        Post::create([
            'title' => 'Seminar Internasional: Kajian Tafsir di Era Digital',
            'slug' => 'seminar-internasional-kajian-tafsir',
            'content' => '<p>Program Studi IAT sukses menyelenggarakan seminar internasional dengan menghadirkan pakar dari berbagai negara...</p>',
            'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
            'category_id' => $cat1->id,
            'user_id' => $admin->id,
            'status' => 'published',
        ]);

        Post::create([
            'title' => 'Dosen dan Mahasiswa IAT Mengadakan Pengabdian di Desa Binaan',
            'slug' => 'pengabdian-desa-binaan-iat',
            'content' => '<p>Sebagai wujud implementasi tridharma perguruan tinggi, prodi IAT melakukan pengabdian masyarakat...</p>',
            'image' => 'https://images.unsplash.com/photo-1593113589914-075568e090a1?auto=format&fit=crop&w=800&q=80',
            'category_id' => $cat3->id,
            'user_id' => $admin->id,
            'status' => 'published',
        ]);

        // Staff
        Staff::create([
            'name' => 'Dr. H. Ahmad Tafsir, M.Ag.',
            'title' => 'Ketua Program Studi',
            'position' => 'Dosen Tetap',
        ]);
        Staff::create([
            'name' => 'Prof. Dr. Siti Aminah, M.A.',
            'title' => 'Guru Besar',
            'position' => 'Dosen Tetap',
        ]);

        // Prodi Statistics
        \App\Models\ProdiStatistic::create([
            'total_mahasiswa' => 450,
            'jumlah_alumni' => 1200,
            'jurnal_terpublikasi' => 320,
        ]);

        // Prodi Profile
        \App\Models\ProdiProfile::create([
            'visi' => "Menjadi Program Studi unggulan yang melahirkan sarjana ilmu Al-Qur'an dan Tafsir yang moderat, inovatif, dan berdaya saing global pada tahun 2030.",
            'misi' => "<ul>
<li>Menyelenggarakan pendidikan dan pengajaran ilmu Al-Qur'an dan Tafsir berbasis teknologi dan pendekatan interdisipliner.</li>
<li>Mengembangkan penelitian unggulan di bidang ilmu Al-Qur'an dan Tafsir yang responsif terhadap isu-isu kontemporer.</li>
<li>Melaksanakan pengabdian kepada masyarakat berbasis nilai-nilai Al-Qur'an untuk pemberdayaan umat.</li>
</ul>",
            'sejarah_singkat' => "<p>Program Studi Ilmu Al-Qur'an dan Tafsir didirikan untuk menjawab kebutuhan masyarakat akan sarjana yang ahli di bidang tafsir Al-Qur'an dan mampu beradaptasi dengan kemajuan teknologi modern.</p>",
        ]);

        // Kurikulum Items
        for ($s = 1; $s <= 8; $s++) {
            \App\Models\KurikulumItem::create([
                'semester' => $s,
                'kode_mk' => "IAT{$s}01",
                'nama_mk' => "Ulumul Qur'an " . ($s > 2 ? 'Lanjutan ' . ($s-2) : ($s > 1 ? 'II' : 'I')),
                'sks' => 3,
                'jenis' => 'Mata Kuliah Wajib Program Studi',
                'deskripsi' => 'Membahas sejarah turunnya Al-Qur\'an, asbabun nuzul, makkiyah-madaniyah, dan pengantar ilmu tafsir.',
            ]);
            \App\Models\KurikulumItem::create([
                'semester' => $s,
                'kode_mk' => "UIN{$s}02",
                'nama_mk' => "Bahasa Arab " . ($s > 1 ? 'II' : 'I'),
                'sks' => 2,
                'jenis' => 'Mata Kuliah Universitas',
                'deskripsi' => 'Fokus pada tata bahasa (Nahwu Shorof) dasar untuk memahami teks klasik berbahasa Arab.',
            ]);
        }

        // Jadwal Kuliah
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        foreach ($days as $day) {
            \App\Models\JadwalKuliah::create([
                'hari' => $day,
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:40',
                'nama_mk' => 'Tafsir Tahlili (' . $day . ')',
                'dosen' => 'Dr. H. Ahmad Tafsir, M.Ag.',
                'ruangan' => 'Ruang A.201',
            ]);
            \App\Models\JadwalKuliah::create([
                'hari' => $day,
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:40',
                'nama_mk' => 'Metodologi Penelitian Al-Qur\'an (' . $day . ')',
                'dosen' => 'Prof. Dr. Siti Aminah, M.A.',
                'ruangan' => 'Lab Multimedia 1',
            ]);
        }

        // Dokumen Akademik
        \App\Models\DokumenAkademik::create([
            'nama_dokumen' => 'Kalender Akademik 2026/2027',
            'file_path' => 'documents/sample-kalender.pdf',
            'deskripsi' => 'Kalender kegiatan akademik resmi program studi IAT TA 2026/2027.',
        ]);
        \App\Models\DokumenAkademik::create([
            'nama_dokumen' => 'Panduan Skripsi & Munaqasyah',
            'file_path' => 'documents/sample-panduan.pdf',
            'deskripsi' => 'Buku pedoman penulisan skripsi dan tata cara ujian munaqasyah.',
        ]);
    }
}
