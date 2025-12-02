<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|in:leak_report,billing_inquiry,connection_request,other',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(), // Assuming user must be logged in, or nullable if guest
            'subject' => $validated['subject'],
            'category' => $validated['category'],
            'message' => $validated['message'],
            'status' => 'open',
        ]);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }
}
