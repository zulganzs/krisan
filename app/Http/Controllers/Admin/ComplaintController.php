<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = SupportTicket::with('user')->latest()->paginate(10);
        return view('admin.complaints.index', compact('tickets'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTicket $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportTicket $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $complaint->update($validated);

        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Ticket status updated successfully.');
    }
}
