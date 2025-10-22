<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumni = [
            [
                'nama' => 'Budi Santoso, S.Kom',
                'nim' => '11223344',
                'program_studi' => 'Teknik Informatika',
                'tahun_lulus' => 2023,
                'ipk' => 3.85,
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567890',
                'linkedin' => 'https://linkedin.com/in/budisantoso',
                'pekerjaan_sekarang' => 'Bekerja',
                'nama_perusahaan' => 'PT Garuda Technology Indonesia',
                'posisi' => 'Senior Software Engineer',
                'alamat_perusahaan' => 'Jl. Sudirman No. 123, Jakarta Selatan',
                'tanggal_mulai_kerja' => '2023-08-01',
                'gaji_range' => 15000000,
                'testimoni' => 'Pengalaman kuliah di Teknik Informatika sangat berkesan. Dosen-dosen yang kompeten dan fasilitas laboratorium yang lengkap sangat membantu dalam mempersiapkan diri menghadapi dunia kerja. Ilmu yang didapat sangat applicable di industri, terutama mata kuliah pemrograman dan database.',
                'pencapaian' => 'Setelah lulus langsung diterima di perusahaan teknologi ternama. Saat ini sedang mengembangkan sistem enterprise untuk klien multinasional. Berhasil mendapatkan sertifikasi AWS Solution Architect Professional dalam 6 bulan pertama bekerja.',
            ],
            [
                'nama' => 'Siti Nurhaliza, S.Kom, M.Kom',
                'nim' => '22334455',
                'program_studi' => 'Teknik Informatika',
                'tahun_lulus' => 2022,
                'ipk' => 3.92,
                'email' => 'siti.nurhaliza@email.com',
                'telepon' => '082345678901',
                'linkedin' => 'https://linkedin.com/in/sitinurhaliza',
                'pekerjaan_sekarang' => 'Melanjutkan Studi',
                'nama_perusahaan' => 'National University of Singapore',
                'posisi' => 'PhD Student in Computer Science',
                'alamat_perusahaan' => '21 Lower Kent Ridge Rd, Singapore 119077',
                'tanggal_mulai_kerja' => '2023-08-15',
                'gaji_range' => 0,
                'testimoni' => 'Program studi ini memberikan fondasi yang sangat kuat dalam ilmu komputer. Berkat bimbingan dosen pembimbing dan kesempatan untuk melakukan penelitian, saya berhasil melanjutkan studi S3 di universitas terkemuka. Publikasi paper di jurnal internasional selama kuliah sangat membantu proses aplikasi beasiswa.',
                'pencapaian' => 'Mendapatkan beasiswa penuh untuk program PhD di NUS dengan fokus penelitian di bidang Machine Learning dan Natural Language Processing. Sudah mempublikasikan 2 paper di konferensi internasional tier-A.',
            ],
            [
                'nama' => 'Ahmad Fauzi, S.Kom',
                'nim' => '33445566',
                'program_studi' => 'Teknik Informatika',
                'tahun_lulus' => 2024,
                'ipk' => 3.78,
                'email' => 'ahmad.fauzi@email.com',
                'telepon' => '083456789012',
                'linkedin' => 'https://linkedin.com/in/ahmadfauzi',
                'pekerjaan_sekarang' => 'Wirausaha',
                'nama_perusahaan' => 'Innov8 Digital Solutions',
                'posisi' => 'CEO & Founder',
                'alamat_perusahaan' => 'Jl. Gatot Subroto No. 45, Bandung',
                'tanggal_mulai_kerja' => '2024-03-01',
                'gaji_range' => 20000000,
                'testimoni' => 'Kuliah di TI bukan hanya belajar coding, tapi juga belajar problem solving dan entrepreneurship. Mata kuliah Technopreneurship dan bimbingan dari dosen membuka wawasan saya untuk memulai startup. Fasilitas inkubator bisnis di kampus sangat membantu di awal-awal.',
                'pencapaian' => 'Berhasil mendirikan startup di bidang digital transformation consulting. Dalam 1 tahun sudah menangani 15+ klien UMKM. Mendapatkan pendanaan seed funding Rp 500 juta dari angel investor. Tim berkembang menjadi 12 orang.',
            ],
            [
                'nama' => 'Maya Kusuma Dewi, S.Kom',
                'nim' => '44556677',
                'program_studi' => 'Teknik Informatika',
                'tahun_lulus' => 2023,
                'ipk' => 3.65,
                'email' => 'maya.dewi@email.com',
                'telepon' => '084567890123',
                'linkedin' => 'https://linkedin.com/in/mayakusumadewi',
                'pekerjaan_sekarang' => 'Bekerja',
                'nama_perusahaan' => 'Bank Central Asia (BCA)',
                'posisi' => 'IT Analyst',
                'alamat_perusahaan' => 'Menara BCA, Grand Indonesia, Jakarta',
                'tanggal_mulai_kerja' => '2023-09-01',
                'gaji_range' => 12000000,
                'testimoni' => 'Terima kasih kepada seluruh dosen TI yang telah membimbing selama 4 tahun. Ilmu yang didapat sangat bermanfaat di dunia perbankan. Khususnya mata kuliah keamanan sistem informasi dan database sangat saya aplikasikan dalam pekerjaan sehari-hari.',
                'pencapaian' => 'Lolos seleksi BCA IT Trainee Program yang sangat kompetitif (acceptance rate < 2%). Saat ini bertanggung jawab dalam pengembangan sistem core banking. Mendapat Employee of the Quarter pada kuartal kedua 2024.',
            ],
            [
                'nama' => 'Reza Pratama Putra, S.Kom',
                'nim' => '55667788',
                'program_studi' => 'Teknik Informatika',
                'tahun_lulus' => 2024,
                'ipk' => 3.70,
                'email' => 'reza.pratama@email.com',
                'telepon' => '085678901234',
                'linkedin' => 'https://linkedin.com/in/rezapratama',
                'pekerjaan_sekarang' => 'Bekerja',
                'nama_perusahaan' => 'Google Indonesia',
                'posisi' => 'Associate Software Engineer',
                'alamat_perusahaan' => 'The Energy Building, SCBD, Jakarta Selatan',
                'tanggal_mulai_kerja' => '2024-07-15',
                'gaji_range' => 25000000,
                'testimoni' => 'Kampus ini memberikan kesempatan luar biasa untuk berkembang. Aktif di komunitas programming dan ikut berbagai kompetisi membuat saya siap menghadapi technical interview di perusahaan global. Terima kasih untuk semua mentor dan teman-teman yang sudah support.',
                'pencapaian' => 'Berhasil lolos Google hiring process yang terkenal sangat sulit. Juara 2 Google Code Jam 2024 regional Asia. Kontributor aktif di beberapa open source project dengan 1000+ stars di GitHub. Menjadi mentor untuk junior di kampus.',
            ],
        ];

        foreach ($alumni as $item) {
            Alumni::create($item);
        }
    }
}
