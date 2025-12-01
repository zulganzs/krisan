<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display the tariff rates page
     * This page will use @foreach loop to render the tariffs table (LOOPING requirement)
     */
    public function index()
    {
        $tariffs = Tariff::orderBy('min_usage')->get();

        return view('tariff', compact('tariffs'));
    }
}
