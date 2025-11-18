<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenelitianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hardcode dosen IDs (1-5 from DosenSeeder)
        $penelitianData = [
            [
                'judul_penelitian' => 'Pengembangan Sistem Informasi Akademik Berbasis Web dengan Laravel',
                'deskripsi' => 'Penelitian ini bertujuan untuk mengembangkan sistem informasi akademik yang dapat memudahkan proses administrasi akademik di perguruan tinggi menggunakan framework Laravel.',
                'tahun' => 2024,
                'jenis_penelitian' => 'Hibah',
                'sumber_dana' => 'DIKTI',
                'dana' => 50000000,
                'status' => 'Sedang Berjalan',
                'tanggal_mulai' => '2024-01-15',
                'tanggal_selesai' => null,
                'output' => 'Jurnal Nasional',
                'file_dokumen' => null,
                'ketua_peneliti_id' => 1,
            ],
            [
                'judul_penelitian' => 'Analisis Dampak Pandemi COVID-19 terhadap Kualitas Pendidikan Tinggi',
                'deskripsi' => 'Studi mendalam tentang bagaimana pandemi COVID-19 mempengaruhi kualitas pendidikan tinggi di Indonesia melalui pembelajaran online.',
                'tahun' => 2023,
                'jenis_penelitian' => 'Mandiri',
                'sumber_dana' => 'Kemenristekdikti',
                'dana' => 75000000,
                'status' => 'Selesai',
                'tanggal_mulai' => '2023-03-01',
                'tanggal_selesai' => '2023-12-31',
                'output' => 'Prosiding Internasional',
                'file_dokumen' => null,
                'ketua_peneliti_id' => 2,
            ],
            [
                'judul_penelitian' => 'Implementasi Machine Learning untuk Prediksi Prestasi Akademik Mahasiswa',
                'deskripsi' => 'Penelitian tentang penerapan algoritma machine learning untuk memprediksi prestasi akademik mahasiswa berdasarkan data historis dan faktor-faktor lainnya.',
                'tahun' => 2024,
                'jenis_penelitian' => 'Kolaborasi',
                'sumber_dana' => 'Mandiri',
                'dana' => 25000000,
                'status' => 'Sedang Berjalan',
                'tanggal_mulai' => '2024-06-01',
                'tanggal_selesai' => null,
                'output' => null,
                'file_dokumen' => null,
                'ketua_peneliti_id' => 3,
            ],
            [
                'judul_penelitian' => 'Pengembangan Model Pembelajaran Blended Learning untuk Mata Kuliah Pemrograman',
                'deskripsi' => 'Penelitian untuk mengembangkan model pembelajaran campuran yang efektif untuk meningkatkan hasil belajar mahasiswa pada mata kuliah pemrograman.',
                'tahun' => 2023,
                'jenis_penelitian' => 'Hibah',
                'sumber_dana' => 'DIKTI',
                'dana' => 60000000,
                'status' => 'Selesai',
                'tanggal_mulai' => '2023-01-01',
                'tanggal_selesai' => '2023-11-30',
                'output' => 'Jurnal Nasional Terakreditasi',
                'file_dokumen' => null,
                'ketua_peneliti_id' => 4,
            ],
            [
                'judul_penelitian' => 'Studi Kelayakan Implementasi Cloud Computing untuk Infrastruktur TI Kampus',
                'deskripsi' => 'Analisis kelayakan implementasi teknologi cloud computing sebagai infrastruktur IT kampus untuk meningkatkan efisiensi dan skalabilitas.',
                'tahun' => 2024,
                'jenis_penelitian' => 'Mandiri',
                'sumber_dana' => 'Kampus',
                'dana' => 35000000,
                'status' => 'Sedang Berjalan',
                'tanggal_mulai' => '2024-04-01',
                'tanggal_selesai' => null,
                'output' => null,
                'file_dokumen' => null,
                'ketua_peneliti_id' => 5,
            ],
        ];

        foreach ($penelitianData as $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('penelitian')->insert($data);
        }

        echo "✅ Penelitian seeded: " . count($penelitianData) . " records\n";
    }
}