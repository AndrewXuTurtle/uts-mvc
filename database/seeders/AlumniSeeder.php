<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $alumniData = [
            [
                'nim' => '20200001',
                'pekerjaan_saat_ini' => 'Bekerja',
                'nama_perusahaan' => 'PT. Tech Indonesia',
                'posisi_jabatan' => 'Software Engineer',
                'alamat_perusahaan' => 'Jl. Sudirman No. 100, Jakarta Pusat',
                'no_hp_perusahaan' => '02123456789',
                'gaji_pertama' => 6000000,
                'gaji_saat_ini' => 8500000,
                'waktu_tunggu_pekerjaan' => 2,
                'kesesuaian_bidang' => 'Sangat Sesuai',
                'status_data' => 'Lengkap',
                'linkedin' => 'https://linkedin.com/in/ahmad-rahman',
                'instagram' => '@ahmadrhmn',
                'pesan_alumni' => 'Belajar TPL sangat membantu karir saya!',
            ],
            [
                'nim' => '20200002',
                'pekerjaan_saat_ini' => 'Bekerja',
                'nama_perusahaan' => 'Startup Digital Solution',
                'posisi_jabatan' => 'Frontend Developer',
                'alamat_perusahaan' => 'Jl. Gatot Subroto No. 88, Jakarta Selatan',
                'no_hp_perusahaan' => '02198765432',
                'gaji_pertama' => 5500000,
                'gaji_saat_ini' => 9000000,
                'waktu_tunggu_pekerjaan' => 3,
                'kesesuaian_bidang' => 'Sangat Sesuai',
                'status_data' => 'Lengkap',
                'linkedin' => 'https://linkedin.com/in/siti-aminah',
                'instagram' => '@sitiaminah',
                'pesan_alumni' => 'Terima kasih atas ilmu yang diberikan!',
            ],
            [
                'nim' => '20200003',
                'pekerjaan_saat_ini' => 'Bekerja',
                'nama_perusahaan' => 'PT. Berkah Tech',
                'posisi_jabatan' => 'Backend Developer',
                'status_data' => 'Belum Lengkap',
            ],
        ];

        foreach ($alumniData as $data) {
            Alumni::create($data);
        }

        $this->command->info('✅ Alumni: ' . count($alumniData) . ' records');
    }
}
