<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates a default admin user for the system
     */
    public function run(): void
    {
        User::create([
            'name' => 'EcoWater Administrator',
            'email' => 'admin@ecowater.local',
            'password' => Hash::make('password'),
            'customer_id' => 'ADMIN-001',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
