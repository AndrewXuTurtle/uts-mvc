<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $matakuliah = [
            // Semester 1
            ['kode_mk' => 'TPL101', 'nama_mk' => 'Pemrograman Dasar', 'sks' => 4, 'semester' => 1, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Pengenalan konsep dasar pemrograman menggunakan Python', 'status_wajib' => true],
            ['kode_mk' => 'TPL102', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Logika, himpunan, relasi, dan graf', 'status_wajib' => true],
            ['kode_mk' => 'TPL103', 'nama_mk' => 'Algoritma dan Struktur Data', 'sks' => 4, 'semester' => 1, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Konsep algoritma, kompleksitas, dan struktur data dasar', 'status_wajib' => true],
            ['kode_mk' => 'TPL104', 'nama_mk' => 'Bahasa Inggris Teknik', 'sks' => 2, 'semester' => 1, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Bahasa Inggris untuk komunikasi teknis', 'status_wajib' => true],
            
            // Semester 2
            ['kode_mk' => 'TPL201', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 2, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Konsep OOP menggunakan Java', 'status_wajib' => true],
            ['kode_mk' => 'TPL202', 'nama_mk' => 'Basis Data', 'sks' => 4, 'semester' => 2, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Desain database, SQL, dan normalisasi', 'status_wajib' => true],
            ['kode_mk' => 'TPL203', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 2, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Konsep sistem operasi dan manajemen resource', 'status_wajib' => true],
            ['kode_mk' => 'TPL204', 'nama_mk' => 'Statistika dan Probabilitas', 'sks' => 3, 'semester' => 2, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Statistika deskriptif dan inferensial', 'status_wajib' => true],
            
            // Semester 3
            ['kode_mk' => 'TPL301', 'nama_mk' => 'Pemrograman Web', 'sks' => 4, 'semester' => 3, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'HTML, CSS, JavaScript, dan PHP', 'status_wajib' => true],
            ['kode_mk' => 'TPL302', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 4, 'semester' => 3, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Software development lifecycle dan metodologi', 'status_wajib' => true],
            ['kode_mk' => 'TPL303', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Protokol jaringan dan arsitektur TCP/IP', 'status_wajib' => true],
            ['kode_mk' => 'TPL304', 'nama_mk' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 3, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'UI/UX design principles', 'status_wajib' => true],
            
            // Semester 4
            ['kode_mk' => 'TPL401', 'nama_mk' => 'Pemrograman Mobile', 'sks' => 4, 'semester' => 4, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Pengembangan aplikasi Android/iOS', 'status_wajib' => true],
            ['kode_mk' => 'TPL402', 'nama_mk' => 'Manajemen Proyek Perangkat Lunak', 'sks' => 3, 'semester' => 4, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Project management dengan Agile/Scrum', 'status_wajib' => true],
            ['kode_mk' => 'TPL403', 'nama_mk' => 'Keamanan Sistem Informasi', 'sks' => 3, 'semester' => 4, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Security principles dan cryptography', 'status_wajib' => true],
            ['kode_mk' => 'TPL404', 'nama_mk' => 'Machine Learning', 'sks' => 3, 'semester' => 4, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Dasar-dasar ML dan AI', 'status_wajib' => false],
            
            // Semester 5
            ['kode_mk' => 'TPL501', 'nama_mk' => 'Framework Pengembangan Web', 'sks' => 4, 'semester' => 5, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Laravel, React, Vue.js', 'status_wajib' => true],
            ['kode_mk' => 'TPL502', 'nama_mk' => 'Cloud Computing', 'sks' => 3, 'semester' => 5, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'AWS, Google Cloud, Azure', 'status_wajib' => false],
            ['kode_mk' => 'TPL503', 'nama_mk' => 'DevOps dan CI/CD', 'sks' => 3, 'semester' => 5, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Docker, Kubernetes, Jenkins', 'status_wajib' => false],
            ['kode_mk' => 'TPL504', 'nama_mk' => 'Big Data dan Analytics', 'sks' => 3, 'semester' => 5, 'kurikulum_tahun' => 2024, 'deskripsi_singkat' => 'Hadoop, Spark, data processing', 'status_wajib' => false],
        ];

        foreach ($matakuliah as $mk) {
            $mk['created_at'] = now();
            $mk['updated_at'] = now();
            DB::table('tbl_matakuliah')->insert($mk);
        }

        echo "✅ Matakuliah seeded: " . count($matakuliah) . " records\n";
    }
}
