<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'tier_name',
        'min_usage',
        'max_usage',
        'price_per_m3',
    ];

    /**
     * Get the rate for a given usage amount (tiered pricing logic)
     * This implements the CONDITIONAL LOGIC requirement
     */
    public static function getRateForUsage(float $usage): float
    {
        // Find the appropriate tariff tier based on usage
        $tariff = self::where('min_usage', '<=', $usage)
            ->where(function($query) use ($usage) {
                $query->whereNull('max_usage')
                      ->orWhere('max_usage', '>=', $usage);
            })
            ->orderBy('min_usage', 'desc')
            ->first();

        return $tariff ? $tariff->price_per_m3 : 0;
    }

    /**
     * Calculate bill amount for given usage
     * This implements the ARITHMETIC requirement: Usage * Rate + Admin Fee
     */
    public static function calculateBill(float $usage, float $adminFee = 5000): array
    {
        $rate = self::getRateForUsage($usage);
        $baseCost = $usage * $rate;  // ARITHMETIC: multiplication
        $totalCost = $baseCost + $adminFee;  // ARITHMETIC: addition

        return [
            'usage' => $usage,
            'rate' => $rate,
            'base_cost' => $baseCost,
            'admin_fee' => $adminFee,
            'total_cost' => $totalCost,
        ];
    }
}
