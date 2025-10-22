<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agenda = [
            [
                'judul' => 'Seminar Nasional Teknologi Informasi 2025',
                'deskripsi' => 'Seminar Nasional dengan tema "Artificial Intelligence for Sustainable Development" menghadirkan pembicara dari berbagai universitas dan industri teknologi. Kegiatan meliputi keynote speech, paper presentation, dan workshop. Pendaftaran dapat dilakukan secara online dengan biaya Rp 150.000 untuk mahasiswa dan Rp 250.000 untuk umum.',
                'tanggal_mulai' => '2025-11-15 08:00:00',
                'tanggal_selesai' => '2025-11-16 16:00:00',
                'lokasi' => 'Auditorium Utama Kampus',
                'penyelenggara' => 'Program Studi Teknik Informatika',
                'kategori' => 'seminar',
                'aktif' => true,
            ],
            [
                'judul' => 'Workshop Cloud Computing dan DevOps',
                'deskripsi' => 'Workshop intensif tentang Cloud Computing menggunakan AWS dan Google Cloud Platform. Materi mencakup EC2, S3, Cloud Functions, Container, Docker, Kubernetes, CI/CD Pipeline, dan best practices DevOps. Peserta akan mendapatkan hands-on experience dan sertifikat. Kuota terbatas 40 peserta.',
                'tanggal_mulai' => '2025-10-25 09:00:00',
                'tanggal_selesai' => '2025-10-27 15:00:00',
                'lokasi' => 'Laboratorium Cloud Computing',
                'penyelenggara' => 'Lab Cloud Computing',
                'kategori' => 'workshop',
                'aktif' => true,
            ],
            [
                'judul' => 'Kuliah Tamu: Career Path in Tech Industry',
                'deskripsi' => 'Kuliah tamu menghadirkan Bapak Indra Wijaya, CTO dari PT Digital Nusantara, yang akan berbagi pengalaman tentang karir di industri teknologi. Topik meliputi skill yang dibutuhkan, tips interview, salary negotiation, dan work-life balance. Terbuka untuk mahasiswa semester 5 ke atas. Wajib registrasi online.',
                'tanggal_mulai' => '2025-11-05 13:00:00',
                'tanggal_selesai' => '2025-11-05 15:30:00',
                'lokasi' => 'Ruang Seminar Lantai 2',
                'penyelenggara' => 'Career Development Center',
                'kategori' => 'seminar',
                'aktif' => true,
            ],
            [
                'judul' => 'Kompetisi Programming Internal 2025',
                'deskripsi' => 'Kompetisi programming untuk mahasiswa Teknik Informatika dengan format ACM ICPC. Tim terdiri dari 3 orang dan akan menyelesaikan problem solving dalam waktu 5 jam. Hadiah total Rp 10.000.000 untuk 3 juara terbaik. Peserta akan mendapatkan sertifikat dan kesempatan menjadi delegasi kompetisi nasional.',
                'tanggal_mulai' => '2025-11-20 08:00:00',
                'tanggal_selesai' => '2025-11-20 13:00:00',
                'lokasi' => 'Laboratorium Komputer 1 & 2',
                'penyelenggara' => 'Himpunan Mahasiswa TI',
                'kategori' => 'acara',
                'aktif' => true,
            ],
            [
                'judul' => 'Dies Natalis Program Studi ke-15',
                'deskripsi' => 'Perayaan Dies Natalis Program Studi Teknik Informatika yang ke-15 dengan rangkaian acara: upacara bendera, talkshow alumni sukses, expo project mahasiswa, donor darah, dan malam keakraban. Seluruh civitas akademika diharapkan dapat hadir. Acara gratis dan terbuka untuk umum.',
                'tanggal_mulai' => '2025-12-01 07:00:00',
                'tanggal_selesai' => '2025-12-01 21:00:00',
                'lokasi' => 'Area Kampus Teknik Informatika',
                'penyelenggara' => 'Panitia Dies Natalis TI',
                'kategori' => 'acara',
                'aktif' => true,
            ],
        ];

        foreach ($agenda as $item) {
            Agenda::create($item);
        }
    }
}
