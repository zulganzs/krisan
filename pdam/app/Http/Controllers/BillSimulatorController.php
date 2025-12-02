<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class BillSimulatorController extends Controller
{
    /**
     * Display the bill simulator form
     */
    public function index()
    {
        return view('bill-simulator');
    }

    /**
     * Calculate the bill based on meter readings and Tariffs
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'previous_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|min:0',
            'admin_fee' => 'nullable|numeric|min:0',
        ]);

        $previousReading = $request->previous_reading;
        $currentReading = $request->current_reading;
        $adminFee = $request->input('admin_fee', 2500); // Default to 2500 if not provided

        // Validation: current reading cannot be less than previous
        if ($currentReading < $previousReading) {
            return back()->withErrors([
                'current_reading' => __('messages.current_reading_error')
            ])->withInput();
        }

        // Calculate usage
        $usage = $currentReading - $previousReading;
        $remainingUsage = $usage;
        $waterCost = 0;
        $breakdown = [];

        // Get Tariffs ordered by usage range
        $tariffs = Tariff::orderBy('min_usage')->get();

        foreach ($tariffs as $tariff) {
            if ($remainingUsage <= 0) {
                break;
            }

            $tierMin = $tariff->min_usage;
            $tierMax = $tariff->max_usage; // Can be null for infinity
            
            // Calculate available volume in this tier
            // If max is null, it's infinite, so take all remaining
            // If max is set, the volume is max - min
            // However, we need to handle the case where tiers might be defined as 0-10, 10-20.
            // Assuming standard definition: 0-10 means up to 10.
            
            // Logic:
            // If tier is 0-10. Usage 25.
            // Tier volume = 10 - 0 = 10.
            // Usage in tier = min(10, 25) = 10.
            // Remaining = 15.
            
            // Tier 2: 10-20.
            // Tier volume = 20 - 10 = 10.
            // Usage in tier = min(10, 15) = 10.
            // Remaining = 5.
            
            // Tier 3: 20-null.
            // Tier volume = infinity.
            // Usage in tier = 5.
            // Remaining = 0.

            $tierVolume = ($tierMax === null) ? PHP_FLOAT_MAX : ($tierMax - $tierMin);
            
            // We need to be careful. The loop assumes we are filling buckets.
            // But we need to know how much of the usage falls into this bucket.
            // Since we ordered by min_usage, we can just consume $remainingUsage up to $tierVolume.
            
            $usageInTier = min($remainingUsage, $tierVolume);
            
            $costInTier = $usageInTier * $tariff->price_per_m3;
            $waterCost += $costInTier;
            
            $breakdown[] = [
                'tier_name' => $tariff->tier_name,
                'usage' => $usageInTier,
                'rate' => $tariff->price_per_m3,
                'cost' => $costInTier,
            ];

            $remainingUsage -= $usageInTier;
        }

        // If no tariffs defined, fallback or 0?
        // Let's assume tariffs exist. If not, cost is 0.

        $totalBill = $waterCost + $adminFee;

        // Calculate average rate for display if needed, or just show base cost
        $averageRate = $usage > 0 ? $waterCost / $usage : 0;

        return view('bill-simulator', [
            'result' => [
                'usage' => $usage,
                'water_cost' => $waterCost,
                'admin_fee' => $adminFee,
                'total_cost' => $totalBill,
                'rate' => $averageRate, // This was used in the view as 'rate_applied'
                'base_cost' => $waterCost,
                'breakdown' => $breakdown // Pass breakdown for potential future use
            ],
            'previous_reading' => $previousReading,
            'current_reading' => $currentReading,
            'admin_fee' => $adminFee,
        ]);
    }
}
