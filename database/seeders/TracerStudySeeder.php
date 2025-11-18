<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TracerStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get alumni from mahasiswa with status Lulus
        $alumniNims = ['20200001', '20200002', '20200003'];

        $tracerStudies = [
            [
                'nim' => '20200001',
                'tahun_survey' => 2024,
                'status_pekerjaan' => 'Bekerja Full Time',
                'nama_perusahaan' => 'PT Tech Indonesia',
                'posisi' => 'Backend Developer',
                'bidang_pekerjaan' => 'Software Development',
                'gaji' => 8000000,
                'waktu_tunggu_kerja' => 2,
                'kesesuaian_bidang_studi' => 'Sangat Sesuai',
                'kepuasan_prodi' => 5,
                'saran_prodi' => 'Tambahkan lebih banyak praktik industri dan proyek real-world. Perbanyak workshop dengan praktisi industri.',
                'kompetensi_didapat' => 'Pemrograman Web (Laravel, React), Database Design, API Development, Git Version Control, Agile/Scrum methodology',
                'saran_pengembangan' => 'Perlu lebih banyak exposure ke teknologi cloud computing dan DevOps practices',
            ],
            [
                'nim' => '20200002',
                'tahun_survey' => 2024,
                'status_pekerjaan' => 'Wiraswasta',
                'nama_perusahaan' => 'EduTech Indonesia (Own Business)',
                'posisi' => 'Founder & CEO',
                'bidang_pekerjaan' => 'Educational Technology',
                'gaji' => 15000000,
                'waktu_tunggu_kerja' => 1,
                'kesesuaian_bidang_studi' => 'Sangat Sesuai',
                'kepuasan_prodi' => 5,
                'saran_prodi' => 'Tambahkan mata kuliah entrepreneurship dan business management untuk mahasiswa yang tertarik membangun startup',
                'kompetensi_didapat' => 'Mobile Development (Flutter), UI/UX Design, Project Management, Leadership, Business Development',
                'saran_pengembangan' => 'Perbanyak program inkubasi startup dan mentoring dari alumni entrepreneur',
            ],
            [
                'nim' => '20200003',
                'tahun_survey' => 2024,
                'status_pekerjaan' => 'Bekerja Full Time',
                'nama_perusahaan' => 'Google Singapore',
                'posisi' => 'Software Engineer',
                'bidang_pekerjaan' => 'Cloud Computing',
                'gaji' => 25000000,
                'waktu_tunggu_kerja' => 3,
                'kesesuaian_bidang_studi' => 'Sangat Sesuai',
                'kepuasan_prodi' => 5,
                'saran_prodi' => 'Kurikulum sudah sangat baik. Pertahankan kualitas dan terus update dengan teknologi terbaru',
                'kompetensi_didapat' => 'Data Structures & Algorithms, System Design, Cloud Architecture (AWS, GCP), Distributed Systems, Machine Learning',
                'saran_pengembangan' => 'Tingkatkan program pertukaran mahasiswa dan internship ke perusahaan tech global',
            ],
        ];

        foreach ($tracerStudies as $data) {
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('tracer_study')->insert($data);
        }

        echo "✅ Tracer Study seeded: " . count($tracerStudies) . " records\n";
    }
}
