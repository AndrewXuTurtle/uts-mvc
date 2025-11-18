<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminExists = User::where('email', 'admin@gmail.com')->first();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ]);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@gmail.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->warn('Admin user already exists!');
        }
    }
}
