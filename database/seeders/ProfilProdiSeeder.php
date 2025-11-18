<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_profil_prodi')->insert([
            'nama_prodi' => 'Teknik Perangkat Lunak',
            'visi' => 'Menjadi Program Studi Teknik Perangkat Lunak yang unggul dan terkemuka dalam menghasilkan lulusan yang kompeten, inovatif, dan beretika tinggi di bidang rekayasa perangkat lunak pada tahun 2030.',
            'misi' => '1. Menyelenggarakan pendidikan tinggi yang berkualitas dan berorientasi pada perkembangan teknologi perangkat lunak terkini.
2. Mengembangkan penelitian dan pengabdian kepada masyarakat yang berdampak pada kemajuan teknologi informasi dan kesejahteraan masyarakat.
3. Membangun kemitraan strategis dengan industri dan institusi pendidikan untuk meningkatkan kualitas pembelajaran dan relevansi lulusan.
4. Menghasilkan lulusan yang memiliki kompetensi teknis, soft skills, dan jiwa kewirausahaan yang kuat.
5. Menciptakan lingkungan akademik yang kondusif untuk pengembangan karakter, kreativitas, dan inovasi.',
            'deskripsi' => 'Program Studi Teknik Perangkat Lunak (TPL) adalah program studi yang fokus pada pengembangan sistem perangkat lunak berkualitas tinggi. Program ini dirancang untuk menghasilkan lulusan yang mampu merancang, mengembangkan, menguji, dan memelihara sistem perangkat lunak dengan menerapkan prinsip-prinsip rekayasa perangkat lunak modern.

Kurikulum TPL mencakup berbagai mata kuliah inti seperti Pemrograman, Struktur Data, Basis Data, Rekayasa Perangkat Lunak, Arsitektur Perangkat Lunak, Pengujian Perangkat Lunak, Mobile Development, Web Development, Cloud Computing, Artificial Intelligence, dan Machine Learning. Mahasiswa juga akan mempelajari metodologi pengembangan seperti Agile, Scrum, dan DevOps.

Program ini dilengkapi dengan laboratorium modern yang mendukung pembelajaran praktis, dosen-dosen berkualifikasi dengan pengalaman industri, serta kerjasama dengan berbagai perusahaan teknologi untuk program magang dan rekrutmen. Lulusan TPL memiliki prospek karir yang cerah di berbagai bidang seperti Software Engineer, Web Developer, Mobile Developer, DevOps Engineer, Data Scientist, System Analyst, Quality Assurance Engineer, dan Tech Entrepreneur.',
            'akreditasi' => 'A (Unggul)',
            'logo' => 'logo-tpl.png',
            'kontak_email' => 'tpl@university.ac.id',
            'kontak_telepon' => '+62 21 1234 5678',
            'alamat' => 'Gedung Fakultas Teknik, Kampus Universitas ABC, Jl. Pendidikan No. 123, Jakarta 12345',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
