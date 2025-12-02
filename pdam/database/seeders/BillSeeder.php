<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have at least one regular user
        $user = User::where('email', 'user@example.com')->first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'customer_id' => 'CUST-' . rand(10000, 99999),
                'is_admin' => false,
            ]);
        }

        // Create bills for this user for the last 6 months
        for ($i = 0; $i < 6; $i++) {
            $month = now()->subMonths($i)->startOfMonth();
            
            // Check if bill already exists for this month
            if (Bill::where('user_id', $user->id)->where('billing_month', $month->format('Y-m-d'))->exists()) {
                continue;
            }

            Bill::factory()->create([
                'user_id' => $user->id,
                'billing_month' => $month->format('Y-m-d'),
                'status' => $i == 0 ? 'unpaid' : 'paid', // Latest unpaid, others paid
            ]);
        }
    }
}
