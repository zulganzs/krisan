<?php

namespace Database\Seeders;

use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Seeds the 3 tariff tiers required for tiered pricing
     */
    public function run(): void
    {
        $tariffs = [
            [
                'tier_name' => 'Tier 1 - Low Usage',
                'min_usage' => 0,
                'max_usage' => 10,
                'price_per_m3' => 2000,
            ],
            [
                'tier_name' => 'Tier 2 - Medium Usage',
                'min_usage' => 10.01,
                'max_usage' => 20,
                'price_per_m3' => 3000,
            ],
            [
                'tier_name' => 'Tier 3 - High Usage',
                'min_usage' => 20.01,
                'max_usage' => null,  // null means unlimited
                'price_per_m3' => 5000,
            ],
        ];

        foreach ($tariffs as $tariff) {
            Tariff::create($tariff);
        }
    }
}
