<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'nim' => '20200001',
                'judul_project' => 'Sistem Informasi Manajemen Perpustakaan Berbasis Web',
                'deskripsi' => 'Aplikasi web untuk mengelola data buku, peminjaman, dan pengembalian di perpustakaan. Dilengkapi dengan fitur notifikasi email otomatis untuk pengingat pengembalian.',
                'tahun' => 2023,
                'tahun_selesai' => 2023,
                'kategori' => 'Web Application',
                'teknologi' => 'Laravel, MySQL, Bootstrap',
                'dosen_pembimbing' => 'Dr. Ahmad Fauzi, M.Kom',
                'link_github' => 'https://github.com/ahmad/perpustakaan-app',
                'link_demo' => 'https://perpus-demo.com',
                'status' => 'Published',
            ],
            [
                'nim' => '20200002',
                'judul_project' => 'Aplikasi Mobile E-Commerce Fashion',
                'deskripsi' => 'Aplikasi mobile untuk jual beli produk fashion online. Terintegrasi dengan payment gateway dan sistem tracking pengiriman real-time.',
                'tahun' => 2023,
                'tahun_selesai' => 2023,
                'kategori' => 'Mobile App',
                'teknologi' => 'Flutter, Firebase, REST API',
                'dosen_pembimbing' => 'Ir. Siti Nurhaliza, M.T',
                'link_github' => 'https://github.com/siti/fashion-ecommerce',
                'status' => 'Published',
            ],
            [
                'nim' => '20200003',
                'judul_project' => 'Sistem Monitoring IoT untuk Smart Home',
                'deskripsi' => 'Sistem monitoring dan kontrol perangkat rumah pintar menggunakan IoT. Dapat mengontrol lampu, AC, dan keamanan rumah melalui aplikasi mobile.',
                'tahun' => 2023,
                'tahun_selesai' => 2023,
                'kategori' => 'IoT',
                'teknologi' => 'Arduino, NodeMCU, MQTT, React Native',
                'dosen_pembimbing' => 'Prof. Dr. Budi Santoso, M.Sc',
                'link_github' => 'https://github.com/budi/smart-home-iot',
                'status' => 'Published',
            ],
            [
                'nim' => '20210004',
                'judul_project' => 'Chatbot Customer Service dengan AI',
                'deskripsi' => 'Chatbot berbasis kecerdasan buatan untuk layanan customer service otomatis. Menggunakan Natural Language Processing untuk memahami pertanyaan pelanggan.',
                'tahun' => 2024,
                'tahun_selesai' => null,
                'kategori' => 'Artificial Intelligence',
                'teknologi' => 'Python, TensorFlow, Flask, DialogFlow',
                'dosen_pembimbing' => 'Dr. Rina Wati, M.Kom',
                'link_github' => 'https://github.com/dewi/ai-chatbot',
                'status' => 'Draft',
            ],
            [
                'nim' => '20210005',
                'judul_project' => 'Sistem Deteksi Penyakit Tanaman dengan Computer Vision',
                'deskripsi' => 'Aplikasi untuk mendeteksi penyakit pada tanaman menggunakan teknologi computer vision dan deep learning. Akurasi deteksi mencapai 95%.',
                'tahun' => 2024,
                'tahun_selesai' => null,
                'kategori' => 'Machine Learning',
                'teknologi' => 'Python, OpenCV, TensorFlow, Flask',
                'dosen_pembimbing' => 'Dr. Ahmad Fauzi, M.Kom',
                'link_github' => 'https://github.com/rizki/plant-disease-detection',
                'status' => 'Draft',
            ],
            [
                'nim' => '20220006',
                'judul_project' => 'Platform Learning Management System',
                'deskripsi' => 'LMS untuk institusi pendidikan dengan fitur video conference, quiz online, dan manajemen tugas. Mendukung pembelajaran hybrid.',
                'tahun' => 2025,
                'tahun_selesai' => null,
                'kategori' => 'Web Application',
                'teknologi' => 'React.js, Node.js, MongoDB, WebRTC',
                'dosen_pembimbing' => 'Ir. Siti Nurhaliza, M.T',
                'link_github' => 'https://github.com/maya/lms-platform',
                'status' => 'Draft',
            ],
            [
                'nim' => '20220007',
                'judul_project' => 'Sistem Parkir Pintar Berbasis QR Code',
                'deskripsi' => 'Sistem parkir otomatis menggunakan QR code untuk entry dan exit. Terintegrasi dengan mobile payment untuk pembayaran cashless.',
                'tahun' => 2025,
                'tahun_selesai' => null,
                'kategori' => 'IoT',
                'teknologi' => 'Laravel, Vue.js, ESP32, QR Scanner',
                'dosen_pembimbing' => 'Prof. Dr. Budi Santoso, M.Sc',
                'status' => 'Draft',
            ],
            [
                'nim' => '20230008',
                'judul_project' => 'Aplikasi Keuangan Pribadi dengan Analisis Prediktif',
                'deskripsi' => 'Aplikasi mobile untuk manajemen keuangan pribadi dengan fitur analisis pengeluaran dan prediksi keuangan masa depan menggunakan machine learning.',
                'tahun' => 2025,
                'tahun_selesai' => null,
                'kategori' => 'Mobile App',
                'teknologi' => 'Flutter, Python, FastAPI, PostgreSQL',
                'dosen_pembimbing' => 'Dr. Rina Wati, M.Kom',
                'status' => 'Draft',
            ],
        ];

        foreach ($projects as $project) {
            $project['created_at'] = now();
            $project['updated_at'] = now();
            DB::table('projects')->insert($project);
        }

        echo "✅ Projects seeded: " . count($projects) . " records\n";
    }
}

