<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard
     */
    public function index()
    {
        $user = auth()->user();
        $bills = $user->bills()->latest('billing_month')->take(5)->get();
        $totalBills = $user->bills()->count();
        $unpaidBills = $user->bills()->where('status', 'unpaid')->count();

        return view('dashboard.index', compact('user', 'bills', 'totalBills', 'unpaidBills'));
    }

    /**
     * Display billing history with @foreach loop (LOOPING requirement)
     */
    public function billingHistory()
    {
        $user = auth()->user();
        $bills = $user->bills()->latest('billing_month')->paginate(15);

        return view('dashboard.billing-history', compact('bills'));
    }
}
