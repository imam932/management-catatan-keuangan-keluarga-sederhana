<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('transactions', TransactionController::class);
    Route::resource('balances', App\Http\Controllers\BalanceController::class);
    Route::resource('balance-histories', App\Http\Controllers\BalanceHistoryController::class)->only(['index', 'show']);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/balance', [DashboardController::class, 'updateBalance'])->name('balance.update');
});

require __DIR__.'/auth.php';