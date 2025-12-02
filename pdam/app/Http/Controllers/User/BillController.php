<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Show the form for creating a new bill (submitting meter reading).
     */
    public function create()
    {
        $user = Auth::user();
        // Get the latest bill to auto-fill previous reading
        $latestBill = $user->bills()->latest('billing_month')->first();
        $previousReading = $latestBill ? $latestBill->current_reading : 0;
        
        return view('user.bills.create', compact('previousReading'));
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'billing_month' => 'required|date',
            'current_reading' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        
        // Ensure billing month is unique for this user
        if ($user->bills()->where('billing_month', $request->billing_month)->exists()) {
            return back()->withErrors(['billing_month' => 'A bill for this month already exists.'])->withInput();
        }

        // Get previous reading
        $latestBill = $user->bills()->latest('billing_month')->first();
        $previousReading = $latestBill ? $latestBill->current_reading : 0;

        if ($request->current_reading < $previousReading) {
            return back()->withErrors(['current_reading' => 'Current reading cannot be less than previous reading.'])->withInput();
        }

        $usage = $request->current_reading - $previousReading;
        
        // Calculate cost using Tariffs (similar to BillSimulator)
        $tariffs = Tariff::orderBy('min_usage')->get();
        $remainingUsage = $usage;
        $waterCost = 0;

        foreach ($tariffs as $tariff) {
            if ($remainingUsage <= 0) break;

            $tierMin = $tariff->min_usage;
            $tierMax = $tariff->max_usage;
            $tierVolume = ($tierMax === null) ? PHP_FLOAT_MAX : ($tierMax - $tierMin);
            $usageInTier = min($remainingUsage, $tierVolume);
            $waterCost += $usageInTier * $tariff->price_per_m3;
            $remainingUsage -= $usageInTier;
        }

        // If no tariffs, fallback to a default rate? Or 0?
        // Let's assume 0 if no tariffs, or maybe a default flat rate if desired.
        // For now, 0 is fine as it encourages setting up tariffs.
        
        $adminFee = 2500;
        $totalCost = $waterCost + $adminFee;
        $rateApplied = $usage > 0 ? $waterCost / $usage : 0;

        Bill::create([
            'user_id' => $user->id,
            'billing_month' => $request->billing_month,
            'previous_reading' => $previousReading,
            'current_reading' => $request->current_reading,
            'usage_m3' => $usage,
            'rate_applied' => $rateApplied,
            'base_cost' => $waterCost,
            'admin_fee' => $adminFee,
            'total_cost' => $totalCost,
            'status' => 'unpaid',
        ]);

        return redirect()->route('dashboard')->with('success', 'Bill created successfully.');
    }
}
