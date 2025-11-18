<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KisahSuksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kisahSukses = [
            [
                'nim' => '20200001',
                'judul' => 'Dari Kampus ke Silicon Valley: Perjalanan Sukses Ahmad Rahman',
                'kisah' => "Setelah lulus dari TPL tahun 2024, saya memulai karir sebagai Junior Developer di startup lokal. Dengan bekal ilmu yang kuat dari kampus terutama dalam pemrograman web dan mobile, saya terus belajar dan berkembang.\n\nDalam 2 tahun, saya berhasil naik menjadi Senior Developer dan memimpin tim kecil. Kesempatan emas datang ketika saya diterima bekerja di salah satu perusahaan tech terbesar di Silicon Valley.\n\nTPL tidak hanya mengajarkan coding, tapi juga problem-solving, teamwork, dan kemampuan belajar mandiri yang sangat membantu karir saya hingga saat ini.",
                'pencapaian' => 'Software Engineer di Google, Silicon Valley',
                'tahun_pencapaian' => 2024,
                'foto' => 'kisah-ahmad.jpg',
                'status' => 'Published',
            ],
            [
                'nim' => '20200002',
                'judul' => 'Membangun Startup EdTech dari Nol - Siti Aminah',
                'kisah' => "Passion saya di bidang pendidikan membawa saya untuk membangun startup EdTech setelah lulus. Awalnya hanya tim kecil 3 orang alumni TPL, sekarang sudah berkembang menjadi 50+ karyawan.\n\nPlatform kami telah digunakan oleh lebih dari 100 ribu siswa di seluruh Indonesia. Ilmu entrepreneurship dan project management yang dipelajari di TPL sangat membantu.\n\nKami juga mendapat pendanaan dari investor lokal dan internasional. Mimpi kami adalah membuat pendidikan berkualitas accessible untuk semua.",
                'pencapaian' => 'Founder & CEO EduTech Indonesia',
                'tahun_pencapaian' => 2024,
                'foto' => 'kisah-siti.jpg',
                'status' => 'Published',
            ],
            [
                'nim' => '20200003',
                'judul' => 'Juara Hackathon Internasional - Budi Santoso',
                'kisah' => "Tim kami dari TPL berhasil memenangkan hackathon internasional di Singapura tahun 2024. Kami bersaing dengan 200+ tim dari berbagai negara.\n\nProyek kami adalah aplikasi AI untuk deteksi dini penyakit menggunakan machine learning. Semua dimulai dari tugas akhir di kampus yang dikembangkan lebih lanjut.\n\nPenghargaan ini membuka banyak pintu peluang, termasuk tawaran kerja dari perusahaan multinasional dan kesempatan melanjutkan S2 dengan beasiswa penuh.",
                'pencapaian' => 'Juara 1 Singapore AI Hackathon 2024',
                'tahun_pencapaian' => 2024,
                'foto' => 'kisah-budi.jpg',
                'status' => 'Published',
            ],
        ];

        foreach ($kisahSukses as $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('kisah_sukses')->insert($data);
        }

        echo "✅ Kisah Sukses seeded: " . count($kisahSukses) . " records\n";
    }
}
