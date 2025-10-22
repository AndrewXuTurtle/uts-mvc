<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeri = [
            // Akademik
            [
                'judul' => 'Wisuda Sarjana Angkatan 2024',
                'deskripsi' => 'Prosesi wisuda sarjana program studi Teknik Informatika angkatan 2024 yang dihadiri oleh 150 lulusan berprestasi. Acara dilaksanakan di Gedung Auditorium Utama dengan khidmat dan meriah.',
                'foto' => 'galeri/wisuda.jpg', // Placeholder, akan diganti dengan foto asli
                'kategori' => 'akademik',
                'tanggal' => '2024-10-15',
                'fotografer' => 'Tim Humas',
                'tampilkan_di_home' => true,
                'urutan' => 1,
            ],
            [
                'judul' => 'Laboratorium Komputer Terbaru',
                'deskripsi' => 'Fasilitas laboratorium komputer yang baru direnovasi dengan perangkat terkini. Dilengkapi dengan 50 unit komputer spesifikasi tinggi, AC, dan koneksi internet berkecepatan tinggi.',
                'foto' => 'galeri/lab.jpg',
                'kategori' => 'fasilitas',
                'tanggal' => '2024-09-20',
                'fotografer' => 'Admin Lab',
                'tampilkan_di_home' => true,
                'urutan' => 2,
            ],

            // Kemahasiswaan
            [
                'judul' => 'Pelatihan Leadership HMTI',
                'deskripsi' => 'Kegiatan pelatihan kepemimpinan untuk pengurus Himpunan Mahasiswa Teknik Informatika periode 2024/2025. Diikuti oleh 40 peserta dengan materi team building dan public speaking.',
                'foto' => 'galeri/leadership.jpg',
                'kategori' => 'kemahasiswaan',
                'tanggal' => '2024-09-10',
                'fotografer' => 'Dokumentasi HMTI',
                'tampilkan_di_home' => false,
                'urutan' => 3,
            ],
            [
                'judul' => 'Bakti Sosial di Desa Sukamaju',
                'deskripsi' => 'Kegiatan pengabdian masyarakat yang diikuti mahasiswa TI berupa pelatihan komputer dasar untuk warga desa. Kegiatan berlangsung selama 2 hari dengan antusias tinggi dari peserta.',
                'foto' => 'galeri/baksos.jpg',
                'kategori' => 'kemahasiswaan',
                'tanggal' => '2024-08-25',
                'fotografer' => 'Panitia Baksos',
                'tampilkan_di_home' => false,
                'urutan' => 4,
            ],

            // Kegiatan
            [
                'judul' => 'Seminar Artificial Intelligence',
                'deskripsi' => 'Seminar nasional dengan tema "AI for Better Future" yang menghadirkan praktisi dan akademisi terkemuka. Dihadiri oleh 300 peserta dari berbagai universitas se-Indonesia.',
                'foto' => 'galeri/seminar-ai.jpg',
                'kategori' => 'kegiatan',
                'tanggal' => '2024-10-05',
                'fotografer' => 'Tim Media',
                'tampilkan_di_home' => true,
                'urutan' => 5,
            ],
            [
                'judul' => 'Workshop Cloud Computing',
                'deskripsi' => 'Workshop hands-on tentang implementasi cloud computing menggunakan AWS dan Google Cloud. Peserta mendapatkan sertifikat dan akses gratis cloud resources selama 3 bulan.',
                'foto' => 'galeri/workshop-cloud.jpg',
                'kategori' => 'kegiatan',
                'tanggal' => '2024-09-28',
                'fotografer' => 'Lab Cloud Computing',
                'tampilkan_di_home' => true,
                'urutan' => 6,
            ],

            // Prestasi
            [
                'judul' => 'Juara 1 Hackathon Nasional 2024',
                'deskripsi' => 'Tim mahasiswa TI meraih juara 1 dalam ajang Hackathon Indonesia 2024 dengan mengembangkan aplikasi smart farming berbasis AI. Mengalahkan 100+ tim dari seluruh Indonesia.',
                'foto' => 'galeri/juara-hackathon.jpg',
                'kategori' => 'prestasi',
                'tanggal' => '2024-10-10',
                'fotografer' => 'Panitia Lomba',
                'tampilkan_di_home' => true,
                'urutan' => 7,
            ],
            [
                'judul' => 'Medali Emas ACM ICPC Asia',
                'deskripsi' => 'Prestasi membanggakan tim programming TI yang meraih medali emas di kompetisi ACM ICPC regional Asia. Ini merupakan pencapaian terbaik dalam sejarah program studi.',
                'foto' => 'galeri/medali-icpc.jpg',
                'kategori' => 'prestasi',
                'tanggal' => '2024-10-03',
                'fotografer' => 'Pendamping Tim',
                'tampilkan_di_home' => true,
                'urutan' => 8,
            ],

            // Fasilitas
            [
                'judul' => 'Perpustakaan Digital Modern',
                'deskripsi' => 'Perpustakaan digital dengan koleksi 10,000+ e-book dan jurnal internasional. Dilengkapi dengan ruang baca yang nyaman, AC, dan WiFi berkecepatan tinggi.',
                'foto' => 'galeri/perpustakaan.jpg',
                'kategori' => 'fasilitas',
                'tanggal' => '2024-08-15',
                'fotografer' => 'Tim Perpustakaan',
                'tampilkan_di_home' => false,
                'urutan' => 9,
            ],
            [
                'judul' => 'Ruang Co-working Space',
                'deskripsi' => 'Fasilitas co-working space untuk mahasiswa yang ingin bekerja tim atau mengerjakan project. Tersedia meeting room, whiteboard, dan fasilitas presentasi lengkap.',
                'foto' => 'galeri/coworking.jpg',
                'kategori' => 'fasilitas',
                'tanggal' => '2024-09-01',
                'fotografer' => 'Admin Fasilitas',
                'tampilkan_di_home' => false,
                'urutan' => 10,
            ],
        ];

        foreach ($galeri as $item) {
            Galeri::create($item);
        }
    }
}
