<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeraturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peraturan = [
            // Akademik
            [
                'judul' => 'Kalender Akademik 2025/2026',
                'deskripsi' => 'Kalender akademik tahun ajaran 2025/2026 yang berisi jadwal kegiatan akademik selama satu tahun.',
                'kategori' => 'Akademik',
                'jenis' => 'Kalender Akademik',
                'file_path' => 'peraturan/kalender_akademik_2025.pdf',
                'file_name' => 'Kalender_Akademik_2025_2026.pdf',
                'file_size' => 2048000,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Panduan Studi Program Studi TPL',
                'deskripsi' => 'Panduan studi lengkap untuk mahasiswa Program Studi Teknik Perangkat Lunak.',
                'kategori' => 'Akademik',
                'jenis' => 'Panduan Studi',
                'file_path' => 'peraturan/panduan_studi_tpl.pdf',
                'file_name' => 'Panduan_Studi_TPL.pdf',
                'file_size' => 5120000,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Pedoman Skripsi dan Tugas Akhir',
                'deskripsi' => 'Pedoman penulisan skripsi dan tugas akhir untuk mahasiswa tingkat akhir.',
                'kategori' => 'Akademik',
                'jenis' => 'Skripsi',
                'file_path' => 'peraturan/pedoman_skripsi.pdf',
                'file_name' => 'Pedoman_Skripsi_TA.pdf',
                'file_size' => 3072000,
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'judul' => 'Panduan Magang dan PKL',
                'deskripsi' => 'Panduan pelaksanaan magang dan praktik kerja lapangan untuk mahasiswa.',
                'kategori' => 'Akademik',
                'jenis' => 'Magang',
                'file_path' => 'peraturan/panduan_magang.pdf',
                'file_name' => 'Panduan_Magang_PKL.pdf',
                'file_size' => 1536000,
                'urutan' => 4,
                'is_active' => true,
            ],
            
            // Kemahasiswaan
            [
                'judul' => 'Tata Tertib Mahasiswa',
                'deskripsi' => 'Peraturan tata tertib yang harus dipatuhi oleh seluruh mahasiswa.',
                'kategori' => 'Kemahasiswaan',
                'jenis' => 'Tata Tertib',
                'file_path' => 'peraturan/tata_tertib.pdf',
                'file_name' => 'Tata_Tertib_Mahasiswa.pdf',
                'file_size' => 1024000,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Kode Etik Mahasiswa',
                'deskripsi' => 'Kode etik dan perilaku yang harus dijunjung tinggi oleh mahasiswa.',
                'kategori' => 'Kemahasiswaan',
                'jenis' => 'Kode Etik',
                'file_path' => 'peraturan/kode_etik.pdf',
                'file_name' => 'Kode_Etik_Mahasiswa.pdf',
                'file_size' => 768000,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Panduan Kegiatan Organisasi Kemahasiswaan',
                'deskripsi' => 'Panduan pelaksanaan kegiatan organisasi dan UKM kampus.',
                'kategori' => 'Kemahasiswaan',
                'jenis' => 'Kegiatan',
                'file_path' => 'peraturan/panduan_organisasi.pdf',
                'file_name' => 'Panduan_Organisasi.pdf',
                'file_size' => 2048000,
                'urutan' => 3,
                'is_active' => true,
            ],
            
            // Administratif
            [
                'judul' => 'SOP Pelayanan Administrasi Akademik',
                'deskripsi' => 'Standar operasional prosedur pelayanan administrasi akademik.',
                'kategori' => 'Administratif',
                'jenis' => 'SOP',
                'file_path' => 'peraturan/sop_administrasi.pdf',
                'file_name' => 'SOP_Administrasi.pdf',
                'file_size' => 1536000,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Format Surat Menyurat Resmi',
                'deskripsi' => 'Template dan format surat menyurat resmi kampus.',
                'kategori' => 'Administratif',
                'jenis' => 'Surat Menyurat',
                'file_path' => 'peraturan/format_surat.pdf',
                'file_name' => 'Format_Surat_Menyurat.pdf',
                'file_size' => 512000,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Prosedur Cuti Kuliah',
                'deskripsi' => 'Prosedur pengajuan cuti kuliah dan persyaratannya.',
                'kategori' => 'Administratif',
                'jenis' => 'Cuti Kuliah',
                'file_path' => 'peraturan/prosedur_cuti.pdf',
                'file_name' => 'Prosedur_Cuti_Kuliah.pdf',
                'file_size' => 1024000,
                'urutan' => 3,
                'is_active' => true,
            ],
            
            // Keuangan
            [
                'judul' => 'Rincian Biaya Kuliah 2025/2026',
                'deskripsi' => 'Rincian biaya pendidikan untuk tahun ajaran 2025/2026.',
                'kategori' => 'Keuangan',
                'jenis' => 'Biaya Kuliah',
                'file_path' => 'peraturan/biaya_kuliah_2025.pdf',
                'file_name' => 'Biaya_Kuliah_2025_2026.pdf',
                'file_size' => 1024000,
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'judul' => 'Informasi Beasiswa dan Bantuan Pendidikan',
                'deskripsi' => 'Informasi lengkap tentang berbagai jenis beasiswa dan bantuan pendidikan.',
                'kategori' => 'Keuangan',
                'jenis' => 'Beasiswa',
                'file_path' => 'peraturan/info_beasiswa.pdf',
                'file_name' => 'Info_Beasiswa.pdf',
                'file_size' => 2048000,
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'judul' => 'Ketentuan Denda Keterlambatan Pembayaran',
                'deskripsi' => 'Peraturan dan ketentuan denda untuk keterlambatan pembayaran.',
                'kategori' => 'Keuangan',
                'jenis' => 'Denda Keterlambatan',
                'file_path' => 'peraturan/denda_keterlambatan.pdf',
                'file_name' => 'Denda_Keterlambatan.pdf',
                'file_size' => 512000,
                'urutan' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($peraturan as $data) {
            DB::table('peraturan')->insert(array_merge($data, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        echo "✅ Peraturan seeded: " . count($peraturan) . " records\n";
    }
}
