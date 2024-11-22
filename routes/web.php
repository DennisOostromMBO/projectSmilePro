<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PraktijkmanagerController;
use App\Http\Controllers\AccountOverzichtController;
use App\Http\Controllers\FactuurController;
use App\Http\Controllers\EmailController;

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
<<<<<<< HEAD
Route::get('/accountoverzicht', [AccountOverzichtController::class, 'index'])->name('AccountOverzicht.index');
<<<<<<< HEAD
=======

Route::resource('factuur', FactuurController::class);
>>>>>>> 8a1db8de1f1d0724edefe25f4fb8e90f0e456255
=======
Route::get('/accountoverzicht', [AccountOverzichtController::class, 'index']);
>>>>>>> b46f02adbb277a9e3abb32704a8427d8fd8d4ab7

// Middleware Praktijkmanager
Route::get('/praktijkmanager/medewerkers', [PraktijkmanagerController::class, 'medewerkers'])->name('praktijkmanager.medewerkers');

Route::get('/beschikbaarheid', [BeschikbaarheidController::class, 'index'])->name('beschikbaarheid.index');

Route::get('/Communicatie', [CommunicatieController::class, 'index'])->name('Communicatie.index');

Route::get('/emails', [EmailController::class, 'index']);
Route::post('/emails', [EmailController::class, 'store']);
require __DIR__ . '/auth.php';
