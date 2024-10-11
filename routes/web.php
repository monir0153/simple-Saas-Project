<?php

use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/addition', [CalculationController::class, 'addition'])->name('addition');
});

Route::middleware('auth')->group(function () {
    Route::get('buy', [OrderController::class, 'index'])->name('buy');
    Route::post('stripe/payment', [OrderController::class, 'create'])->name('stripe.payment');
});

require __DIR__ . '/auth.php';
