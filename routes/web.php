<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VariableController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/formula/create', [FormulaController::class, 'create'])->name('formula.create');
    Route::get('/formula/{id?}', [FormulaController::class, 'index'])->name('formula.index');
    Route::post('/formula', [FormulaController::class, 'store'])->name('formula.store');
    Route::patch('/formula/{id}', [FormulaController::class, 'update'])->name('formula.update');
    Route::delete('/formula/{id}', [FormulaController::class, 'destroy'])->name('formula.destroy');

    Route::get('/formula/variable/create', [VariableController::class, 'create'])->name('formula.variable.create');
    Route::post('/formula/variable', [VariableController::class, 'store'])->name('formula.variable.store');
    Route::delete('/formula/variable/{id}', [VariableController::class, 'destroy'])->name('formula.variable.destroy');

    Route::get('/formula/label/create', [LabelController::class, 'create'])->name('formula.label.create');
    Route::post('/formula/label', [LabelController::class, 'store'])->name('formula.label.store');
    Route::delete('/formula/label/{id}', [LabelController::class, 'destroy'])->name('formula.label.destroy');

    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::get('/project/search/', [ProjectController::class, 'search'])->name('project.search');
    Route::get('/project/{id?}', [ProjectController::class, 'index'])->name('project.index');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/calculate', [ProjectController::class, 'showCalculation'])->name('project.show.calculate');
    Route::post('/project/calculate', [ProjectController::class, 'calculate'])->name('project.calculate');
    Route::post('/project/{id}/update', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    Route::get('/reports', function () {
        return redirect('dashboard');
    })->name('reports');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

// Terms of service
Route::get('/terms-of-service', function () {
    return view('auth.terms-of-service');
})->name('terms');

// Privacy policy
Route::get('/privacy-policy', function () {
    return view('auth.privacy-policy');
})->name('policy');

require __DIR__ . '/auth.php';
