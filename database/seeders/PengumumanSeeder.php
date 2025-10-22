<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengumuman = [
            [
                'judul' => 'Pendaftaran Tugas Akhir Semester Ganjil 2025/2026',
                'isi' => 'Pendaftaran Tugas Akhir untuk semester ganjil 2025/2026 telah dibuka. Mahasiswa yang telah memenuhi syarat (minimal 120 SKS dan IPK ≥ 2.50) dapat mendaftar melalui sistem akademik online mulai tanggal 1-15 November 2025. Dokumen yang perlu disiapkan: KHS, transkrip sementara, proposal TA, dan kartu bimbingan. Informasi lebih lanjut dapat menghubungi koordinator Tugas Akhir di ruang dosen lantai 3.',
                'penulis' => 'Koordinator TA',
                'tanggal_mulai' => '2025-11-01',
                'tanggal_selesai' => '2025-11-15',
                'prioritas' => 'tinggi',
                'aktif' => true,
            ],
            [
                'judul' => 'Jadwal Ujian Tengah Semester Ganjil 2025/2026',
                'isi' => 'Ujian Tengah Semester (UTS) untuk semester ganjil 2025/2026 akan dilaksanakan pada tanggal 4-11 November 2025. Mahasiswa dimohon untuk memeriksa jadwal ujian masing-masing melalui portal akademik. Ketentuan ujian: membawa kartu ujian, datang 15 menit sebelum ujian dimulai, mematikan handphone selama ujian. Ujian susulan hanya diberikan dengan alasan yang dapat dipertanggungjawabkan disertai surat keterangan resmi.',
                'penulis' => 'Bagian Akademik',
                'tanggal_mulai' => '2025-11-04',
                'tanggal_selesai' => '2025-11-11',
                'prioritas' => 'tinggi',
                'aktif' => true,
            ],
            [
                'judul' => 'Beasiswa PPA dan BBM Semester Ganjil 2025/2026',
                'isi' => 'Pendaftaran beasiswa Peningkatan Prestasi Akademik (PPA) dan Bantuan Belajar Mahasiswa (BBM) untuk semester ganjil 2025/2026 telah dibuka. Persyaratan PPA: IPK minimal 3.00, aktif dalam organisasi. Persyaratan BBM: IPK minimal 2.75, penghasilan orang tua maksimal Rp 3.000.000. Pendaftaran dilakukan secara online melalui portal kemahasiswaan dengan melampirkan dokumen pendukung. Batas akhir pendaftaran: 30 Oktober 2025.',
                'penulis' => 'Bagian Kemahasiswaan',
                'tanggal_mulai' => '2025-10-15',
                'tanggal_selesai' => '2025-10-30',
                'prioritas' => 'sedang',
                'aktif' => true,
            ],
            [
                'judul' => 'Penutupan Sistem Akademik untuk Maintenance',
                'isi' => 'Sistem akademik online akan ditutup sementara untuk maintenance pada tanggal 28 Oktober 2025 pukul 20.00 - 29 Oktober 2025 pukul 06.00 WIB. Selama periode ini, mahasiswa tidak dapat mengakses layanan akademik online termasuk KRS, KHS, dan portal pembelajaran. Mohon untuk menyelesaikan keperluan akademik sebelum waktu maintenance. Terima kasih atas perhatian dan kerjasamanya.',
                'penulis' => 'IT Support',
                'tanggal_mulai' => '2025-10-28',
                'tanggal_selesai' => '2025-10-29',
                'prioritas' => 'tinggi',
                'aktif' => true,
            ],
            [
                'judul' => 'Rekrutmen Asisten Laboratorium Periode 2026',
                'isi' => 'Laboratorium Teknik Informatika membuka rekrutmen asisten laboratorium untuk periode Januari-Juni 2026. Posisi yang tersedia: Asisten Lab Pemrograman, Asisten Lab Database, Asisten Lab Jaringan, dan Asisten Lab Mobile. Persyaratan: mahasiswa semester 5-7, IPK minimal 3.25, lulus mata kuliah terkait dengan nilai minimal A. Pendaftaran melalui email labti@university.ac.id dengan melampirkan CV, transkrip, dan surat rekomendasi dosen. Batas pendaftaran: 5 November 2025.',
                'penulis' => 'Kepala Laboratorium TI',
                'tanggal_mulai' => '2025-10-20',
                'tanggal_selesai' => '2025-11-05',
                'prioritas' => 'sedang',
                'aktif' => true,
            ],
        ];

        foreach ($pengumuman as $item) {
            Pengumuman::create($item);
        }
    }
}
