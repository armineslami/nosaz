<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () { return redirect('dashboard'); });
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/formula', [FormulaController::class, 'edit'])->name('formula.edit');

    Route::get('/projects', function () {
        return redirect('dashboard');
    })->name('projects.edit');

    Route::get('/reports', function () {
        return redirect('dashboard');
    })->name('reports');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Terms of service
Route::get('/terms-of-service', function () {
    return view('auth.terms-of-service');
})->name('terms');

// Privacy policy
Route::get('/privacy-policy', function () {
    return view('auth.privacy-policy');
})->name('policy');

require __DIR__.'/auth.php';
