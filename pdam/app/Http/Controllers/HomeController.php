<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        $announcements = Announcement::active()
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('announcements'));
    }

    /**
     * Display the About Us page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the Contact page
     */
    public function contact()
    {
        return view('contact');
    }
}
