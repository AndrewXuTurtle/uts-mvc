<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\PKM;
use App\Models\Penelitian;
use App\Models\Alumni;
use App\Models\TracerStudy;
use App\Models\KisahSukses;
use App\Models\Berita;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class ComprehensiveSeeder extends Seeder
{
    /**
     * Run the database seeds - creates 50+ records for each major feature.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        
        // Get all mahasiswa and dosen
        $allMahasiswa = Mahasiswa::all();
        $activeMahasiswa = Mahasiswa::where('status', 'Aktif')->get();
        $lulusMahasiswa = Mahasiswa::where('status', 'Lulus')->get();
        $allDosen = Dosen::all();
        
        $this->command->info('🚀 Starting comprehensive seeder...');
        
        // ===== PROJECT SEEDER (50 projects) =====
        $this->command->info('📦 Creating 50 projects...');
        $kategoriProject = ['Website', 'Mobile App', 'Desktop App', 'IoT', 'Game'];
        $statusProject = ['ongoing', 'completed', 'published'];
        $tahunProject = [2021, 2022, 2023, 2024, 2025];
        
        foreach ($activeMahasiswa->take(50) as $index => $mhs) {
            Project::create([
                'nim' => $mhs->nim,
                'judul_project' => $faker->sentence(4) . ' ' . $faker->randomElement(['System', 'Platform', 'Application', 'Portal']),
                'deskripsi' => $faker->paragraphs(3, true),
                'kategori' => $faker->randomElement($kategoriProject),
                'teknologi' => implode(', ', $faker->randomElements(['Laravel', 'React', 'Vue', 'Flutter', 'Node.js', 'Python', 'Java', 'Kotlin', 'Swift'], 3)),
                'link_github' => $faker->boolean(70) ? 'https://github.com/' . strtolower(str_replace(' ', '', $mhs->nama)) . '/project-' . ($index + 1) : null,
                'link_demo' => $faker->boolean(50) ? 'https://demo-project' . ($index + 1) . '.vercel.app' : null,
                'tahun' => $faker->randomElement($tahunProject),
                'tahun_selesai' => $faker->boolean(60) ? $faker->randomElement([2024, 2025, 2026]) : null,
                'status' => $faker->randomElement(['Draft', 'Published']),
                'dosen_pembimbing' => $allDosen->random()->nama,
                'cover_image' => null,
                'galeri' => null,
            ]);
        }
        $this->command->info('   ✅ 50 projects created');
        
        // ===== PKM SEEDER (35 PKM) =====
        $this->command->info('🤝 Creating 35 PKM programs...');
        $jenisPKM = ['PKM-R', 'PKM-K', 'PKM-M', 'PKM-T', 'PKM-KC', 'PKM-AI', 'PKM-GT'];
        $statusPKM = ['Proposal', 'Didanai', 'Selesai'];
        $pencapaian = ['Lolos Dikti', 'Didanai', 'Juara 1', 'Juara 2', 'Juara 3', 'Peserta'];
        
        for ($i = 1; $i <= 35; $i++) {
            $pkm = PKM::create([
                'judul_pkm' => 'PKM ' . $faker->sentence(5),
                'deskripsi' => $faker->paragraphs(4, true),
                'tahun' => $faker->randomElement([2022, 2023, 2024, 2025]),
                'jenis_pkm' => $faker->randomElement($jenisPKM),
                'status' => $faker->randomElement($statusPKM),
                'dana' => $faker->randomFloat(2, 5000000, 25000000),
                'pencapaian' => $faker->randomElement($pencapaian),
                'file_dokumen' => null,
                'dosen_pembimbing_id' => $allDosen->random()->id,
            ]);
            
            // Attach 3-5 mahasiswa using NIM
            $pkm->mahasiswa()->attach($activeMahasiswa->random(rand(3, 5))->pluck('nim'));
        }
        $this->command->info('   ✅ 35 PKM programs created with dosen & mahasiswa relationships');
        
        // ===== PENELITIAN SEEDER (30 penelitian) =====
        $this->command->info('🔬 Creating 30 penelitian...');
        $jenisPenelitian = ['Mandiri', 'Hibah', 'Kolaborasi'];
        $sumberDana = ['Internal', 'DIKTI', 'Kemenristek', 'Swasta', 'Hibah Internasional'];
        $statusPenelitian = ['Draft', 'Sedang Berjalan', 'Selesai'];
        $output = ['Jurnal Nasional', 'Jurnal Internasional', 'Prosiding', 'Paten', 'Buku'];
        
        for ($i = 1; $i <= 30; $i++) {
            Penelitian::create([
                'judul_penelitian' => 'Penelitian ' . $faker->sentence(6),
                'deskripsi' => $faker->paragraphs(3, true),
                'tahun' => $faker->randomElement([2022, 2023, 2024, 2025]),
                'jenis_penelitian' => $faker->randomElement($jenisPenelitian),
                'sumber_dana' => $faker->randomElement($sumberDana),
                'dana' => $faker->randomFloat(2, 10000000, 100000000),
                'status' => $faker->randomElement($statusPenelitian),
                'tanggal_mulai' => $faker->dateTimeBetween('-2 years', 'now'),
                'tanggal_selesai' => $faker->boolean(60) ? $faker->dateTimeBetween('now', '+1 year') : null,
                'output' => $faker->randomElement($output),
                'file_dokumen' => null,
                'ketua_peneliti_id' => $allDosen->random()->id,
            ]);
        }
        $this->command->info('   ✅ 30 penelitian created');
        
        // ===== ALUMNI SEEDER (45 alumni from lulus mahasiswa) =====
        $this->command->info('🎓 Creating 45 alumni...');
        $pekerjaanSektor = ['Swasta', 'BUMN', 'Startup', 'Pemerintah', 'Freelance', 'Wirausaha'];
        $posisiJabatan = [
            'Software Engineer',
            'Frontend Developer',
            'Backend Developer',
            'Full Stack Developer',
            'Mobile Developer',
            'Data Analyst',
            'Data Scientist',
            'DevOps Engineer',
            'UI/UX Designer',
            'Product Manager',
            'Tech Lead',
            'Engineering Manager'
        ];
        $kesesuaianBidang = ['Sangat Sesuai', 'Sesuai', 'Cukup Sesuai', 'Kurang Sesuai'];
        
        // Ensure we have enough lulus mahasiswa, if not create more alumni manually
        $targetAlumni = 45;
        $existingLulus = $lulusMahasiswa->count();
        
        foreach ($lulusMahasiswa->take($targetAlumni) as $mhs) {
            Alumni::create([
                'nim' => $mhs->nim,
                'pekerjaan_saat_ini' => $faker->randomElement($posisiJabatan),
                'nama_perusahaan' => $faker->company,
                'posisi_jabatan' => $faker->randomElement($posisiJabatan),
                'alamat_perusahaan' => $faker->address,
                'no_hp_perusahaan' => '08' . $faker->numerify('##########'),
                'gaji_pertama' => $faker->randomElement([4000000, 5000000, 6000000, 7000000]),
                'gaji_saat_ini' => $faker->randomElement([7000000, 10000000, 12000000, 15000000, 20000000]),
                'waktu_tunggu_pekerjaan' => $faker->numberBetween(1, 12),
                'kesesuaian_bidang' => $faker->randomElement($kesesuaianBidang),
                'status_data' => 'Lengkap',
                'linkedin' => $faker->boolean(80) ? 'https://linkedin.com/in/' . strtolower(str_replace(' ', '-', $mhs->nama)) : null,
                'instagram' => $faker->boolean(60) ? '@' . strtolower(str_replace(' ', '', $mhs->nama)) : null,
                'facebook' => null,
                'pesan_alumni' => $faker->boolean(70) ? $faker->paragraph : null,
                'foto_alumni' => null,
            ]);
        }
        
        // If not enough lulus mahasiswa, create additional alumni from aktif mahasiswa (simulating future graduates)
        if ($existingLulus < $targetAlumni) {
            $additionalNeeded = $targetAlumni - $existingLulus;
            foreach ($activeMahasiswa->take($additionalNeeded) as $mhs) {
                Alumni::create([
                    'nim' => $mhs->nim,
                    'pekerjaan_saat_ini' => $faker->randomElement($posisiJabatan),
                    'nama_perusahaan' => $faker->company,
                    'posisi_jabatan' => $faker->randomElement($posisiJabatan),
                    'alamat_perusahaan' => $faker->address,
                    'no_hp_perusahaan' => '08' . $faker->numerify('##########'),
                    'gaji_pertama' => $faker->randomElement([4000000, 5000000, 6000000, 7000000]),
                    'gaji_saat_ini' => $faker->randomElement([7000000, 10000000, 12000000, 15000000, 20000000]),
                    'waktu_tunggu_pekerjaan' => $faker->numberBetween(1, 12),
                    'kesesuaian_bidang' => $faker->randomElement($kesesuaianBidang),
                    'status_data' => 'Lengkap',
                    'linkedin' => $faker->boolean(80) ? 'https://linkedin.com/in/' . strtolower(str_replace(' ', '-', $mhs->nama)) : null,
                    'instagram' => $faker->boolean(60) ? '@' . strtolower(str_replace(' ', '', $mhs->nama)) : null,
                    'facebook' => null,
                    'pesan_alumni' => $faker->boolean(70) ? $faker->paragraph : null,
                    'foto_alumni' => null,
                ]);
            }
        }
        $this->command->info('   ✅ 45 alumni created');
        
        $this->command->info('');
        $this->command->info('✅ COMPREHENSIVE SEEDER COMPLETED!');
        $this->command->info('   📦 50 Projects');
        $this->command->info('   🤝 35 PKM (with dosen & mahasiswa relationships)');
        $this->command->info('   🔬 30 Penelitian');
        $this->command->info('   🎓 45 Alumni');
        $this->command->info('   Note: Run TracerStudySeeder, KisahSuksesSeeder, and BeritaSeeder separately for additional data');
    }
}
