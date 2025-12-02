<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tariffs = Tariff::all();
        return view('admin.tariffs.index', compact('tariffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tariffs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tier_name' => 'required|string|max:255',
            'min_usage' => 'required|integer|min:0',
            'max_usage' => 'nullable|integer|gt:min_usage',
            'price_per_m3' => 'required|numeric|min:0',
        ]);

        Tariff::create($validated);

        return redirect()->route('admin.tariffs.index')
            ->with('success', 'Tariff created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tariff $tariff)
    {
        return view('admin.tariffs.edit', compact('tariff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tariff $tariff)
    {
        $validated = $request->validate([
            'tier_name' => 'required|string|max:255',
            'min_usage' => 'required|integer|min:0',
            'max_usage' => 'nullable|integer|gt:min_usage',
            'price_per_m3' => 'required|numeric|min:0',
        ]);

        $tariff->update($validated);

        return redirect()->route('admin.tariffs.index')
            ->with('success', 'Tariff updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();

        return redirect()->route('admin.tariffs.index')
            ->with('success', 'Tariff deleted successfully.');
    }
}
