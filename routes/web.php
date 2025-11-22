<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for basic hospital management
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('doctors', \App\Http\Controllers\DoctorController::class);
    Route::resource('appointments', \App\Http\Controllers\AppointmentController::class);
});

require __DIR__.'/auth.php';
