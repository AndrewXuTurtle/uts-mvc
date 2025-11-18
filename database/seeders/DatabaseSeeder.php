<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create test user if not exists
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed base data (users, dosen, mahasiswa, alumni)
        $this->call([
            AdminUserSeeder::class,
            DosenSeeder::class,
            MahasiswaSeeder::class,
        ]);
        
        // Seed comprehensive data (projects, PKM, penelitian, alumni, tracer study, kisah sukses, prestasi)
        // This seeder creates 50+ records for each major feature
        $this->call([
            ComprehensiveSeeder::class,
            KisahSuksesSeeder::class,
            TracerStudySeeder::class,
        ]);
        
        // Seed content data (berita, agenda, galeri, pengumuman, profil prodi)
        $this->call([
            BeritaSeeder::class,
            AgendaSeeder::class,
            GaleriSeeder::class,
            PengumumanSeeder::class,
            ProfilProdiSeeder::class,
            PeraturanSeeder::class,
        ]);
        
        // Seed academic data (matakuliah, kurikulum)
        $this->call([
            MatakuliahSeeder::class,
            KurikulumSeeder::class,
        ]);
        
        $this->command->info('');
        $this->command->info('🎉 Database seeded successfully!');
        $this->command->info('👤 Admin: admin@gmail.com / admin123');
        $this->command->info('📊 All tables populated with COMPREHENSIVE sample data:');
        $this->command->info('   - 60 Mahasiswa');
        $this->command->info('   - 25 Dosen');
        $this->command->info('   - 50 Projects');
        $this->command->info('   - 35 PKM');
        $this->command->info('   - 30 Penelitian');
        $this->command->info('   - 45 Alumni');
        $this->command->info('   - 40 Tracer Study');
        $this->command->info('   - 25 Kisah Sukses');
        $this->command->info('   - 35 Prestasi');
    }
}
