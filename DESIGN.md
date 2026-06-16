# Design Specification: Website Program Studi (Prodi)
Dokumen ini berisi spesifikasi desain, arsitektur informasi, dan kebutuhan sistem untuk pengembangan Website Program Studi dengan konsep *modern, clean*, dan berfokus pada publikasi kegiatan prodi.
---
## 1. Identitas Visual & Estetika

Website ini mengadopsi gaya **Modern & Clean** dengan ruang putih (*whitespace*) yang cukup, tipografi yang tegas, dan navigasi yang intuitif untuk memberikan kesan profesional dan dinamis.

### Palet Warna
* **Primary Color:** Red Maroon (`#800000` / `#6B1D2F`) — Melambangkan ketegasan, institusi, dan profesionalisme.
* **Secondary Color:** Charcoal/Dark Slate (`#2C3E50` / `#1A1A1A`) — Untuk teks utama dan elemen navigasi agar kontras.
* **Background Color:** Pure White (`#FFFFFF`) & Light Gray (`#F8F9FA`) — Menjaga tampilan tetap *clean* dan fokus pada konten.
* **Accent Color:** Soft Gold/Amber (`#D4AF37`) — Digunakan secara minimalis untuk *hover state*, tombol penting, atau *badge* prestasi.

### Tipografi
* **Headings (H1, H2, H3):** Inter / Sans-serif atau Montserrat (Bold) — Untuk kesan modern dan kuat.
* **Body Text:** Roboto / Open Sans (Regular) — Untuk tingkat keterbacaan (*readability*) yang tinggi pada artikel blog.

---

## 2. Arsitektur Informasi (Sitemap)

Untuk menonjolkan kegiatan prodi, menu **Blog/Kegiatan** diletakkan di posisi yang strategis dan mendominasi halaman utama (*Homepage*).

[Home]
├── Profil (Visi Misi, Dosen, Fasilitas)
├── Akademik (Kurikulum, Jadwal)
├── Kegiatan & Berita (Sistem Blog Utama) <--- Sorotan Utama
├── Kontak
└── [Admin Portal] (Akses Sistem CRUD)
---

## 3. Tata Letak Antarmuka (UI/UX Layout)

### 3.1. Halaman Utama (Homepage) - *Skenario Fokus Kegiatan*
1.  **Hero Section:** * Slider visual atau video pendek kegiatan mahasiswa/dosen berkualitas tinggi.
    * *Headline* prodi yang persuasif dengan tombol *Call to Action* (CTA) menuju "Lihat Kegiatan Kami".
2.  **Highlight Kegiatan Terbaru (Sistem Blog):**
    * Grid berisi 3-4 artikel/kegiatan terbaru dengan foto beresolusi tinggi, tanggal, dan kategori (misal: Pengabdian Masyarakat, Prestasi, Seminar).
    * Desain menggunakan *card* modern dengan efek *hover shadow* minimalis.
3.  **Sekilas Prodi & Angka Konten:**
    * Statistik singkat (Jumlah Mahasiswa, Alumni, Jurnal Terpublikasi).
4.  **Agenda Mendatang (Upcoming Events):**
    * Daftar kegiatan yang akan datang dalam bentuk kalender mini/list bersih.

### 3.2. Halaman Detail Blog/Artikel
* Tata letak satu kolom yang bersih (fokus baca) dengan *sidebar* minimalis di sisi kanan untuk "Artikel Populer" dan "Kategori".
* Fitur *share* ke media sosial dan tagar (tags) terkait kegiatan.
---

## 4. Spesifikasi Sistem & Fitur CRUD
Sistem ini dibagi menjadi dua sisi: **Public View** (Akses Pengunjung) dan **Admin Panel** (Akses Pengelola Prodi untuk fungsi CRUD).

### 4.1. Fitur CRUD Utama (Admin Panel)
Pengelola prodi dapat melakukan manajemen konten berikut:

| Entitas Data | Create (Tambah) | Read (Tampil) | Update (Ubah) | Delete (Hapus) |
| :--- | :--- | :--- | :--- | :--- |
| **Artikel/Kegiatan (Blog)** | Menulis artikel baru + upload gambar utama | Daftar artikel di admin panel & halaman publik | Mengedit isi konten, status (draft/publish) | Menghapus artikel/kegiatan |
| **Kategori Blog** | Tambah kategori baru (cth: Workshop, Prestasi) | List kategori untuk filter | Mengubah nama kategori | Hapus kategori (relasi ke artikel aman) |
| **Data Dosen/Staf** | Tambah data dosen baru + foto | List dosen di halaman profil | Update jabatan atau gelar | Hapus data dosen |
| **Pengumuman** | Tambah pengumuman penting (banner/text) | Tampil di jumbotron/running text | Edit masa berlaku pengumuman | Hapus pengumuman |

### 4.2. Fitur Pendukung Blog
* **Rich Text Editor (WYSIWYG):** Admin dapat menyisipkan foto di dalam teks artikel dengan mudah (misal menggunakan CKEditor atau TinyMCE).
* **Sistem Komentar (Opsional):** Bisa diintegrasikan dengan Disqus atau dinonaktifkan demi menjaga keamanan konten.
* **Pencarian & Filter:** Pengunjung dapat mencari kegiatan berdasarkan kata kunci atau kategori.

---

## 5. Rancangan Struktur Data (Skema Database Sederhana)

Berikut adalah entitas utama yang wajib ada untuk mendukung sistem blog dan CRUD:

### Tabel: `users` (Untuk Admin/Penulis)
* `id` (PK)
* `username` (Varchar)
* `password` (Hash)
* `role` (Enum: 'superadmin', 'author')

### Tabel: `posts` (Untuk Sistem Blog/Kegiatan)
* `id` (PK)
* `title` (Varchar)
* `slug` (Varchar, untuk URL ramah SEO)
* `content` (Text)
* `image` (Varchar, nama file gambar utama)
* `category_id` (FK ke tabel categories)
* `user_id` (FK ke tabel users)
* `status` (Enum: 'draft', 'published')
* `created_at` & `updated_at` (Timestamp)

### Tabel: `categories`
* `id` (PK)
* `name` (Varchar)
* `slug` (Varchar)
---

## 6. Teknologi yang Direkomendasikan (Tech Stack)

Untuk mengimplementasikan desain dan sistem di atas secara modern dan bersih:
* **Frontend:** Tailwind CSS (sangat direkomendasikan untuk tema *clean* dan modern) kombinasi dengan React (Next.js) atau Vue.js. Jika ingin monolitik, bisa menggunakan Blade (Laravel) dengan Tailwind.
* **Backend & CRUD:** Laravel (PHP).
* **Database:** MySQL.