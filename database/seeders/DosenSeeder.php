<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenData = [
            [
                'nidn' => '0015100101',
                'nama' => 'Dr. Ahmad Surya, S.Kom., M.Kom.',
                'email' => 'ahmad.surya@tpl.ac.id',
                'no_hp' => '081234567801',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Lektor Kepala',
                'pendidikan_terakhir' => 'S3 Ilmu Komputer',
                'bidang_keahlian' => 'Software Engineering, Web Development',
                'alamat' => 'Jl. Merdeka No. 15, Jakarta',
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => 'https://scholar.google.com/citations?user=AhmadSurya123',
                'sinta_link' => 'https://sinta.kemdikbud.go.id/authors/profile/6001234',
                'scopus_link' => 'https://www.scopus.com/authid/detail.uri?authorId=57123456789',
            ],
            [
                'nidn' => '0025040102',
                'nama' => 'Dr. Siti Nurhaliza, S.Kom., M.T.',
                'email' => 'siti.nurhaliza@tpl.ac.id',
                'no_hp' => '081234567802',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Lektor',
                'pendidikan_terakhir' => 'S3 Teknologi Informasi',
                'bidang_keahlian' => 'Mobile Development, UI/UX Design',
                'alamat' => 'Jl. Sudirman No. 25, Jakarta',
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => 'https://scholar.google.com/citations?user=SitiNurhaliza456',
                'sinta_link' => 'https://sinta.kemdikbud.go.id/authors/profile/6001235',
                'scopus_link' => 'https://www.scopus.com/authid/detail.uri?authorId=57123456790',
            ],
            [
                'nidn' => '0030120103',
                'nama' => 'Prof. Dr. Budi Santoso, S.Kom., M.Kom.',
                'email' => 'budi.santoso@tpl.ac.id',
                'no_hp' => '081234567803',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Profesor',
                'pendidikan_terakhir' => 'S3 Ilmu Komputer',
                'bidang_keahlian' => 'Data Science, Machine Learning, AI',
                'alamat' => 'Jl. Gatot Subroto No. 10, Jakarta',
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => 'https://scholar.google.com/citations?user=BudiSantoso789',
                'sinta_link' => 'https://sinta.kemdikbud.go.id/authors/profile/6001236',
                'scopus_link' => 'https://www.scopus.com/authid/detail.uri?authorId=57123456791',
            ],
            [
                'nidn' => '0045080104',
                'nama' => 'Maya Sari, S.Kom., M.T.',
                'email' => 'maya.sari@tpl.ac.id',
                'no_hp' => '081234567804',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Asisten Ahli',
                'pendidikan_terakhir' => 'S2 Teknik Informatika',
                'bidang_keahlian' => 'Database, Cloud Computing',
                'alamat' => 'Jl. Thamrin No. 30, Jakarta',
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => 'https://scholar.google.com/citations?user=MayaSari012',
                'sinta_link' => 'https://sinta.kemdikbud.go.id/authors/profile/6001237',
                'scopus_link' => null,
            ],
            [
                'nidn' => '0050010105',
                'nama' => 'Dr. Hendro Wicaksono, S.Kom., M.Sc.',
                'email' => 'hendro.wicaksono@tpl.ac.id',
                'no_hp' => '081234567805',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Lektor Kepala',
                'pendidikan_terakhir' => 'S3 Computer Science',
                'bidang_keahlian' => 'Cyber Security, Network Security',
                'alamat' => 'Jl. Kuningan No. 45, Jakarta',
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => 'https://scholar.google.com/citations?user=HendroWicaksono345',
                'sinta_link' => 'https://sinta.kemdikbud.go.id/authors/profile/6001238',
                'scopus_link' => 'https://www.scopus.com/authid/detail.uri?authorId=57123456792',
            ],
        ];

        foreach ($dosenData as $data) {
            Dosen::create($data);
        }

        // Generate additional 20 dosen using Faker
        $faker = \Faker\Factory::create('id_ID');
        $jabatan = ['Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Profesor'];
        $pendidikan = ['S2 Teknik Informatika', 'S3 Ilmu Komputer', 'S3 Teknologi Informasi', 'S3 Computer Science'];
        $bidangKeahlian = [
            'Software Engineering',
            'Mobile Development',
            'Web Development',
            'Data Science',
            'Machine Learning',
            'Artificial Intelligence',
            'Cyber Security',
            'Cloud Computing',
            'Database Management',
            'IoT Development',
            'Game Development',
            'UI/UX Design'
        ];
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        
        for ($i = 6; $i <= 25; $i++) {
            $jk = $faker->randomElement($jenisKelamin);
            $nama = $jk === 'Laki-laki' ? $faker->firstNameMale : $faker->firstNameFemale;
            $namaLengkap = $nama . ' ' . $faker->lastName;
            $gelar = $faker->randomElement(['S.Kom.', 'S.T.', 'S.Si.']);
            $gelarAkhir = $faker->randomElement(['M.Kom.', 'M.T.', 'M.Sc.', 'M.Eng.', 'Dr.']);
            
            $selectedJabatan = $faker->randomElement($jabatan);
            if ($selectedJabatan === 'Profesor') {
                $namaLengkapDenganGelar = 'Prof. Dr. ' . $namaLengkap . ', ' . $gelar . ', ' . $gelarAkhir;
            } elseif ($gelarAkhir === 'Dr.') {
                $namaLengkapDenganGelar = 'Dr. ' . $namaLengkap . ', ' . $gelar . ', ' . $gelarAkhir;
            } else {
                $namaLengkapDenganGelar = $namaLengkap . ', ' . $gelar . ', ' . $gelarAkhir;
            }
            
            $bidang1 = $faker->randomElement($bidangKeahlian);
            $bidang2 = $faker->randomElement(array_diff($bidangKeahlian, [$bidang1]));
            
            $hasScholarLinks = $faker->boolean(70); // 70% have scholar links
            
            Dosen::create([
                'nidn' => '00' . str_pad($i, 2, '0', STR_PAD_LEFT) . $faker->numerify('######'),
                'nama' => $namaLengkapDenganGelar,
                'email' => strtolower(str_replace(' ', '.', $namaLengkap)) . '@tpl.ac.id',
                'no_hp' => '08' . $faker->numerify('##########'),
                'jenis_kelamin' => $jk,
                'jabatan' => $selectedJabatan,
                'pendidikan_terakhir' => $faker->randomElement($pendidikan),
                'bidang_keahlian' => $bidang1 . ', ' . $bidang2,
                'alamat' => $faker->address,
                'prodi' => 'Teknik Perangkat Lunak',
                'status' => 'Aktif',
                'google_scholar_link' => $hasScholarLinks ? 'https://scholar.google.com/citations?user=' . $faker->bothify('??????????##') : null,
                'sinta_link' => $hasScholarLinks ? 'https://sinta.kemdikbud.go.id/authors/profile/' . $faker->numerify('60012##') : null,
                'scopus_link' => $hasScholarLinks && $faker->boolean(60) ? 'https://www.scopus.com/authid/detail.uri?authorId=571234567' . $faker->numerify('##') : null,
            ]);
        }

        $this->command->info('✅ Dosen seeder completed! 25 dosen created.');
        $this->command->info('   - Mixed jabatan: Asisten Ahli, Lektor, Lektor Kepala, Profesor');
        $this->command->info('   - Various bidang keahlian');
        $this->command->info('   - Academic profile links included');
    }
}