<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\SupportTicket;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::where('is_admin', false)->count(),
            'total_tariffs' => Tariff::count(),
            'total_bills' => Bill::count(),
            'open_tickets' => SupportTicket::where('status', 'open')->count(),
            'recent_tickets' => SupportTicket::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
