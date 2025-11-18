<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaData = [
            // Mahasiswa yang sudah lulus (tahun masuk 2020, sekarang 2025 = sudah 5 tahun)
            [
                'nim' => '20200001',
                'nama' => 'Ahmad Rahman',
                'email' => 'ahmad.rahman@student.tpl.ac.id',
                'no_hp' => '081234560001',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Kebon Jeruk No. 12, Jakarta Barat',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2002-05-15',
                'tahun_masuk' => 2020,
                'kelas' => 'TPL-A',
                'status' => 'Lulus',
                'tahun_lulus' => 2024,
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20200002',
                'nama' => 'Siti Aminah',
                'email' => 'siti.aminah@student.tpl.ac.id',
                'no_hp' => '081234560002',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Cendana No. 45, Jakarta Selatan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2002-08-20',
                'tahun_masuk' => 2020,
                'kelas' => 'TPL-A',
                'status' => 'Lulus',
                'tahun_lulus' => 2024,
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20200003',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@student.tpl.ac.id',
                'no_hp' => '081234560003',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Melati No. 78, Jakarta Timur',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2001-11-10',
                'tahun_masuk' => 2020,
                'kelas' => 'TPL-B',
                'status' => 'Lulus',
                'tahun_lulus' => 2024,
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            
            // Mahasiswa tahun 2021 (eligible untuk lulus)
            [
                'nim' => '20210004',
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@student.tpl.ac.id',
                'no_hp' => '081234560004',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Mawar No. 23, Jakarta Pusat',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2003-03-25',
                'tahun_masuk' => 2021,
                'kelas' => 'TPL-A',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20210005',
                'nama' => 'Rizki Pratama',
                'email' => 'rizki.pratama@student.tpl.ac.id',
                'no_hp' => '081234560005',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Anggrek No. 56, Jakarta Utara',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2003-07-12',
                'tahun_masuk' => 2021,
                'kelas' => 'TPL-B',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            
            // Mahasiswa aktif (belum eligible lulus)
            [
                'nim' => '20220006',
                'nama' => 'Maya Anggraini',
                'email' => 'maya.anggraini@student.tpl.ac.id',
                'no_hp' => '081234560006',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Flamboyan No. 89, Jakarta Selatan',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2004-02-18',
                'tahun_masuk' => 2022,
                'kelas' => 'TPL-A',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20220007',
                'nama' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@student.tpl.ac.id',
                'no_hp' => '081234560007',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Dahlia No. 34, Jakarta Barat',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2004-09-05',
                'tahun_masuk' => 2022,
                'kelas' => 'TPL-B',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20230008',
                'nama' => 'Intan Permata',
                'email' => 'intan.permata@student.tpl.ac.id',
                'no_hp' => '081234560008',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Kenanga No. 67, Jakarta Timur',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '2005-04-30',
                'tahun_masuk' => 2023,
                'kelas' => 'TPL-A',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20230009',
                'nama' => 'Andi Wijaya',
                'email' => 'andi.wijaya@student.tpl.ac.id',
                'no_hp' => '081234560009',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Teratai No. 90, Jakarta Pusat',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2005-06-14',
                'tahun_masuk' => 2023,
                'kelas' => 'TPL-B',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
            [
                'nim' => '20240010',
                'nama' => 'Linda Kusuma',
                'email' => 'linda.kusuma@student.tpl.ac.id',
                'no_hp' => '081234560010',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Sakura No. 12, Jakarta Selatan',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2006-01-22',
                'tahun_masuk' => 2024,
                'kelas' => 'TPL-A',
                'status' => 'Aktif',
                'prodi' => 'Teknik Perangkat Lunak',
            ],
        ];

        foreach ($mahasiswaData as $data) {
            Mahasiswa::create($data);
        }

        // Generate additional 50 mahasiswa using Faker
        $faker = \Faker\Factory::create('id_ID');
        $kelas = ['TPL-A', 'TPL-B', 'TPL-C'];
        $tahunMasuk = [2020, 2021, 2022, 2023, 2024];
        $jenisKelamin = ['Laki-laki', 'Perempuan'];
        
        for ($i = 11; $i <= 60; $i++) {
            $tahun = $faker->randomElement($tahunMasuk);
            $status = $tahun <= 2020 ? $faker->randomElement(['Lulus', 'Aktif']) : 'Aktif';
            $tahunLulus = ($status === 'Lulus') ? ($tahun + 4) : null;
            
            Mahasiswa::create([
                'nim' => $tahun . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'no_hp' => '08' . $faker->numerify('##########'),
                'jenis_kelamin' => $faker->randomElement($jenisKelamin),
                'alamat' => $faker->address,
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '-18 years'),
                'tahun_masuk' => $tahun,
                'kelas' => $faker->randomElement($kelas),
                'status' => $status,
                'tahun_lulus' => $tahunLulus,
                'prodi' => 'Teknik Perangkat Lunak',
            ]);
        }

        $this->command->info('✅ Mahasiswa seeder completed! 60 mahasiswa created.');
        $this->command->info('   - Mixed status: Aktif and Lulus');
        $this->command->info('   - Years: 2020-2024');
        $this->command->info('   - Classes: TPL-A, TPL-B, TPL-C');
    }
}