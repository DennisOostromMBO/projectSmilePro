<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PraktijkmanagerController;
use App\Http\Controllers\AccountOverzichtController;
use App\Http\Controllers\FactuurController;

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

Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('/accountoverzicht', [AccountOverzichtController::class, 'index'])->name('AccountOverzicht.index');

Route::get('/factuurs', [FactuurController::class, 'index'])->name('factuur.index');
Route::get('/factuurs/create', [FactuurController::class, 'create'])->name('factuur.create');
Route::post('/factuurs', [FactuurController::class, 'store'])->name('factuur.store');
Route::get('/factuurs/{id}/edit', [FactuurController::class, 'edit'])->name('factuur.edit');
Route::put('/factuurs/{id}', [FactuurController::class, 'update'])->name('factuur.update');

// Middleware Praktijkmanager
Route::get('/praktijkmanager/medewerkers', [PraktijkmanagerController::class, 'medewerkers'])->name('praktijkmanager.medewerkers');

require __DIR__ . '/auth.php';
