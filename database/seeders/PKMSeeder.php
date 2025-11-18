<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pkmData = [
            [
                'judul_pkm' => 'Pengembangan Aplikasi Mobile untuk Monitoring Kesehatan Mahasiswa',
                'deskripsi' => 'PKM ini bertujuan untuk mengembangkan aplikasi mobile yang dapat membantu mahasiswa memantau kesehatan mereka secara mandiri dengan fitur tracking kesehatan, reminder obat, dan konsultasi online.',
                'tahun' => 2024,
                'jenis_pkm' => 'PKM-K',
                'status' => 'Didanai',
                'dana' => 15000000,
                'pencapaian' => 'Lolos Pendanaan DIKTI 2024',
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 1,
            ],
            [
                'judul_pkm' => 'Sistem Informasi Geografis untuk Pemetaan Potensi Wisata Daerah',
                'deskripsi' => 'Pengembangan SIG berbasis web untuk memetakan potensi wisata daerah dengan menggunakan teknologi web GIS dan mobile app untuk wisatawan.',
                'tahun' => 2023,
                'jenis_pkm' => 'PKM-M',
                'status' => 'Selesai',
                'dana' => 20000000,
                'pencapaian' => 'Juara 2 PIMNAS 2023',
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 2,
            ],
            [
                'judul_pkm' => 'Robot Pendeteksi dan Pembersih Sampah Otomatis',
                'deskripsi' => 'Perancangan dan pembuatan robot berbasis IoT yang dapat mendeteksi serta membersihkan sampah di lingkungan kampus secara otomatis menggunakan AI computer vision.',
                'tahun' => 2024,
                'jenis_pkm' => 'PKM-T',
                'status' => 'Didanai',
                'dana' => 25000000,
                'pencapaian' => 'Lolos Pendanaan DIKTI 2024',
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 3,
            ],
            [
                'judul_pkm' => 'Aplikasi E-Learning Interaktif untuk Pembelajaran Matematika',
                'deskripsi' => 'Pengembangan aplikasi e-learning dengan fitur gamifikasi, quiz interaktif, dan video tutorial untuk memudahkan pembelajaran matematika siswa SMA.',
                'tahun' => 2023,
                'jenis_pkm' => 'PKM-K',
                'status' => 'Selesai',
                'dana' => 12000000,
                'pencapaian' => 'Lolos PKM 2023, Implementasi di 5 Sekolah',
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 4,
            ],
            [
                'judul_pkm' => 'Pengembangan Produk Herbal untuk Kesehatan Kulit',
                'deskripsi' => 'Riset dan pengembangan produk herbal alami untuk perawatan kesehatan kulit berbasis bahan lokal Indonesia dengan standar BPOM.',
                'tahun' => 2022,
                'jenis_pkm' => 'PKM-R',
                'status' => 'Selesai',
                'dana' => 18000000,
                'pencapaian' => 'Produk Terdaftar BPOM, Juara 3 PIMNAS 2022',
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 5,
            ],
            [
                'judul_pkm' => 'Smart Traffic Light System dengan Machine Learning',
                'deskripsi' => 'Sistem lampu lalu lintas pintar yang menggunakan machine learning untuk mengatur durasi lampu berdasarkan kepadatan traffic real-time.',
                'tahun' => 2024,
                'jenis_pkm' => 'PKM-KC',
                'status' => 'Proposal',
                'dana' => null,
                'pencapaian' => null,
                'file_dokumen' => null,
                'dosen_pembimbing_id' => 1,
            ],
        ];

        foreach ($pkmData as $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('pkm')->insert($data);
        }

        echo "✅ PKM seeded: " . count($pkmData) . " records\n";
    }
}