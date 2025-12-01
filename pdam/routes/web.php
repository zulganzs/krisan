<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\BillSimulatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Language switcher
Route::get('/locale/{locale}', [LocaleController::class, 'set'])->name('locale.set');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/tariff', [TariffController::class, 'index'])->name('tariff');
Route::get('/bill-simulator', [BillSimulatorController::class, 'index'])->name('bill-simulator');
Route::post('/bill-simulator', [BillSimulatorController::class, 'calculate'])->name('bill-simulator.calculate');

// Authentication routes provided by Breeze
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/billing-history', [UserDashboardController::class, 'billingHistory'])->name('billing-history');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
});
