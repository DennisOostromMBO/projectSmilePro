<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PraktijkmanagerController;
use App\Http\Controllers\AccountOverzichtController;
use App\Http\Controllers\BeschikbaarheidController;
use App\Http\Controllers\CommunicatieController;
use App\Http\Controllers\FactuurController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AfsprakenController;

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

// Middleware Praktijkmanager
Route::get('/praktijkmanager/medewerkers', [PraktijkmanagerController::class, 'medewerkers'])->name('praktijkmanager.medewerkers');

Route::get('/Communicatie', [CommunicatieController::class, 'index'])->name('Communicatie.index');

Route::get('/emails', [EmailController::class, 'index']);
Route::post('/emails', [EmailController::class, 'store']);

Route::get('/beschikbaarheid', [BeschikbaarheidController::class, 'index']);
Route::post('/get-beschikbaarheden', [BeschikbaarheidController::class, 'getBeschikbaarheden']);


Route::resource('afspraken', AfsprakenController::class);
require __DIR__ . '/auth.php';


