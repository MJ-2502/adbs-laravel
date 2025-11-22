<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@barangay.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'address' => 'Barangay Hall',
            'contact_number' => '09171234567',
        ]);

        // Create resident user
        User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'resident@barangay.local',
            'password' => Hash::make('password'),
            'role' => 'resident',
            'address' => '123 Sampaguita Street',
            'contact_number' => '09187654321',
        ]);
    }
}
