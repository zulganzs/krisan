<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('user')->latest('billing_month')->paginate(10);
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.bills.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'billing_month' => 'required|date',
            'previous_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|gte:previous_reading',
            'admin_fee' => 'nullable|numeric|min:0',
            'status' => 'required|in:paid,unpaid,overdue',
        ]);

        $usage = $request->current_reading - $request->previous_reading;
        // Simplified calculation for manual entry - normally would use Tariff logic
        // For now, let's assume a standard rate or allow manual override if needed.
        // But to keep it simple and consistent with simulator, we might want to use Tariff logic here too.
        // However, for manual admin entry, maybe they just want to enter the amounts?
        // The migration has fields for amounts.
        // Let's calculate based on a fixed rate for now or just 3000 as in factory.
        $rate = 3000; 
        $baseCost = $usage * $rate;
        $adminFee = $request->input('admin_fee', 2500);
        $totalCost = $baseCost + $adminFee;

        Bill::create([
            'user_id' => $request->user_id,
            'billing_month' => $request->billing_month,
            'previous_reading' => $request->previous_reading,
            'current_reading' => $request->current_reading,
            'usage_m3' => $usage,
            'rate_applied' => $rate,
            'base_cost' => $baseCost,
            'admin_fee' => $adminFee,
            'total_cost' => $totalCost,
            'status' => $request->status,
            'paid_at' => $request->status === 'paid' ? now() : null,
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Bill created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.bills.create', compact('bill', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'billing_month' => 'required|date',
            'previous_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|gte:previous_reading',
            'admin_fee' => 'nullable|numeric|min:0',
            'status' => 'required|in:paid,unpaid,overdue',
        ]);

        $usage = $request->current_reading - $request->previous_reading;
        $rate = 3000;
        $baseCost = $usage * $rate;
        $adminFee = $request->input('admin_fee', 2500);
        $totalCost = $baseCost + $adminFee;

        $bill->update([
            'user_id' => $request->user_id,
            'billing_month' => $request->billing_month,
            'previous_reading' => $request->previous_reading,
            'current_reading' => $request->current_reading,
            'usage_m3' => $usage,
            'rate_applied' => $rate,
            'base_cost' => $baseCost,
            'admin_fee' => $adminFee,
            'total_cost' => $totalCost,
            'status' => $request->status,
            'paid_at' => ($request->status === 'paid' && !$bill->paid_at) ? now() : ($request->status !== 'paid' ? null : $bill->paid_at),
        ]);

        return redirect()->route('admin.bills.index')->with('success', 'Bill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('admin.bills.index')->with('success', 'Bill deleted successfully.');
    }
}
