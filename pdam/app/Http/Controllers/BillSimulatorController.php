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
     * Calculate the bill based on meter readings
     * Implements ARITHMETIC and LOGIC requirements
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'previous_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|min:0',
            'kode_golongan' => 'required|exists:golongan_tarifs,kode_golongan',
        ]);

        $previousReading = $request->previous_reading;
        $currentReading = $request->current_reading;
        $kodeGolongan = $request->kode_golongan;

        // Validation: current reading cannot be less than previous
        if ($currentReading < $previousReading) {
            return back()->withErrors([
                'current_reading' => __('messages.current_reading_error')
            ])->withInput();
        }

        // Calculate usage
        $usage = $currentReading - $previousReading;

        // Get Tariff Data
        $golongan = \App\Models\GolonganTarif::find($kodeGolongan);
        $baseRate = $golongan->harga_per_m3;
        $bebanTetap = $golongan->beban_tetap;
        $biayaAdmin = 2500;

        // Progressive Logic
        // 0-10 m3: Base Rate
        // 11-20 m3: Base Rate + 1500
        // >20 m3: Base Rate + 3000
        
        $waterCost = 0;
        if ($usage <= 10) {
            $waterCost = $usage * $baseRate;
        } elseif ($usage <= 20) {
            $firstBlock = 10 * $baseRate;
            $secondBlock = ($usage - 10) * ($baseRate + 1500);
            $waterCost = $firstBlock + $secondBlock;
        } else {
            $firstBlock = 10 * $baseRate;
            $secondBlock = 10 * ($baseRate + 1500);
            $thirdBlock = ($usage - 20) * ($baseRate + 3000);
            $waterCost = $firstBlock + $secondBlock + $thirdBlock;
        }

        $totalBill = $waterCost + $bebanTetap + $biayaAdmin;

        return view('bill-simulator', [
            'result' => [
                'usage' => $usage,
                'water_cost' => $waterCost,
                'admin_fee' => $biayaAdmin,
                'maintenance_fee' => $bebanTetap,
                'total_cost' => $totalBill,
                'golongan' => $golongan
            ],
            'previous_reading' => $previousReading,
            'current_reading' => $currentReading,
            'selected_golongan' => $kodeGolongan,
            'golongans' => \App\Models\GolonganTarif::all()
        ]);
    }
}
