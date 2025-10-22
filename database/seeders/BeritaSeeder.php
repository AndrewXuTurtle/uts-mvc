<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berita = [
            // 3 Berita Biasa
            [
                'judul' => 'Seminar Nasional Teknologi Informasi 2025',
                'isi' => 'Program Studi Teknik Informatika akan mengadakan Seminar Nasional Teknologi Informasi (SNTI) 2025 pada tanggal 15-16 November 2025. Seminar ini mengangkat tema "Artificial Intelligence for Sustainable Development" dengan menghadirkan pembicara dari berbagai universitas ternama dan praktisi industri teknologi. Kegiatan ini terbuka untuk mahasiswa, dosen, dan umum dengan sistem registrasi online.',
                'penulis' => 'Admin TI',
                'tanggal' => '2025-10-20',
                'is_prestasi' => false,
            ],
            [
                'judul' => 'Kerjasama Industri dengan PT Garuda Technology',
                'isi' => 'Program Studi Teknik Informatika menjalin kerjasama strategis dengan PT Garuda Technology dalam program magang dan rekrutmen lulusan. Kerjasama ini mencakup kuliah tamu, workshop, dan kesempatan magang untuk mahasiswa semester 6 dan 7. PT Garuda Technology merupakan perusahaan teknologi terkemuka yang bergerak di bidang pengembangan software enterprise dan cloud computing.',
                'penulis' => 'Humas TI',
                'tanggal' => '2025-10-18',
                'is_prestasi' => false,
            ],
            [
                'judul' => 'Workshop Cloud Computing dan DevOps',
                'isi' => 'Laboratorium Cloud Computing mengadakan workshop intensif tentang Cloud Computing dan DevOps menggunakan platform AWS dan Google Cloud. Workshop ini akan dilaksanakan selama 3 hari mulai tanggal 25-27 Oktober 2025. Peserta akan belajar tentang deployment aplikasi, CI/CD pipeline, container orchestration dengan Kubernetes, dan best practices dalam DevOps. Sertifikat akan diberikan kepada peserta yang menyelesaikan seluruh rangkaian workshop.',
                'penulis' => 'Lab Cloud Computing',
                'tanggal' => '2025-10-15',
                'is_prestasi' => false,
            ],
            
            // 2 Berita Prestasi
            [
                'judul' => 'Mahasiswa TI Juara 1 Kompetisi Hackathon Nasional',
                'isi' => 'Tim mahasiswa Teknik Informatika berhasil meraih juara 1 dalam kompetisi Hackathon Indonesia 2025 yang diselenggarakan oleh Kementerian Komunikasi dan Informatika. Tim yang beranggotakan Budi Santoso, Maya Sari, dan Reza Pratama berhasil mengembangkan aplikasi berbasis AI untuk deteksi dini penyakit tanaman pertanian. Aplikasi ini dinilai inovatif dan memiliki potensi besar untuk membantu petani Indonesia meningkatkan produktivitas.',
                'penulis' => 'Humas TI',
                'tanggal' => '2025-10-10',
                'is_prestasi' => true,
                'nama_mahasiswa' => 'Budi Santoso',
                'nim' => '11223344',
                'program_studi' => 'Teknik Informatika',
                'tingkat_prestasi' => 'Nasional',
                'jenis_prestasi' => 'Kompetisi Teknologi',
                'penyelenggara' => 'Kementerian Komunikasi dan Informatika',
                'tanggal_prestasi' => '2025-10-08',
            ],
            [
                'judul' => 'Mahasiswa TI Raih Medali Emas di ACM ICPC Asia',
                'isi' => 'Tim programming mahasiswa Teknik Informatika berhasil meraih medali emas dalam kompetisi ACM International Collegiate Programming Contest (ICPC) Asia Regional 2025. Tim yang terdiri dari Ahmad Fauzi, Siti Nurhaliza, dan Doni Prasetyo berhasil menyelesaikan 8 dari 10 problem dengan waktu tercepat. Ini merupakan prestasi terbaik yang pernah diraih oleh universitas dalam kompetisi programming tingkat Asia.',
                'penulis' => 'Koordinator Olimpiade TI',
                'tanggal' => '2025-10-05',
                'is_prestasi' => true,
                'nama_mahasiswa' => 'Ahmad Fauzi',
                'nim' => '22334455',
                'program_studi' => 'Teknik Informatika',
                'tingkat_prestasi' => 'Internasional',
                'jenis_prestasi' => 'Kompetisi Programming',
                'penyelenggara' => 'ACM ICPC',
                'tanggal_prestasi' => '2025-10-03',
            ],
        ];

        foreach ($berita as $item) {
            Berita::create($item);
        }
    }
}
