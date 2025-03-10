<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PraktijkmanagerController;
use App\Http\Controllers\AccountOverzichtController;
use App\Http\Controllers\BeschikbaarheidController;
use App\Http\Controllers\CommunicatieController;
use App\Http\Controllers\FactuurController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AfsprakenController;
use App\Http\Controllers\AboutUsController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Account Overzicht routes
Route::get('accountoverzicht', [AccountOverzichtController::class, 'index'])->name('accountoverzicht.index');
Route::get('accountoverzicht', [AccountOverzichtController::class, 'index'])->name('accountoverzicht.index');
Route::get('accountoverzicht/{id}/edit', [AccountOverzichtController::class, 'edit'])->name('accountoverzicht.edit');
Route::put('accountoverzicht/{id}', [AccountOverzichtController::class, 'update'])->name('accountoverzicht.update');
Route::delete('accountoverzicht/{id}', [AccountOverzichtController::class, 'destroy'])->name('accountoverzicht.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
Route::get('/patient/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');
Route::put('/patient/update/{id}', [PatientController::class, 'update'])->name('patient.update');
Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');


Route::get('/factuurs', [FactuurController::class, 'index'])->name('factuur.index');
Route::get('/factuurs/create', [FactuurController::class, 'create'])->name('factuur.create');
Route::post('/factuurs', [FactuurController::class, 'store'])->name('factuur.store');
Route::get('/factuurs/{id}/edit', [FactuurController::class, 'edit'])->name('factuur.edit');
Route::put('/factuurs/{id}', [FactuurController::class, 'update'])->name('factuur.update');
Route::delete('/factuurs/{id}', [FactuurController::class, 'destroy'])->name('factuur.destroy');

// Middleware Praktijkmanager
Route::get('/praktijkmanager/medewerkers', [PraktijkmanagerController::class, 'medewerkers'])->name('praktijkmanager.medewerkers');
Route::get('/praktijkmanager/edit/{id}', [PraktijkmanagerController::class, 'edit'])->name('medewerkers.edit');
Route::put('/praktijkmanager/update/{id}', [PraktijkmanagerController::class, 'update'])->name('medewerkers.update');
Route::get('/praktijkmanager/create', [PraktijkmanagerController::class, 'create'])->name('medewerkers.create');
Route::post('/praktijkmanager/medewerkers', [PraktijkmanagerController::class, 'store'])->name('medewerkers.store');
Route::delete('/praktijkmanager/medewerkers/{id}', [PraktijkmanagerController::class, 'destroy'])->name('medewerkers.destroy');

Route::get('/Communicatie', [CommunicatieController::class, 'index'])->name('Communicatie.index');

Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
Route::post('/emails', [EmailController::class, 'store'])->name('emails.store');
Route::get('/emails/{id}', [EmailController::class, 'show'])->name('emails.show');
Route::put('/emails/{id}', [EmailController::class, 'update'])->name('emails.update');

Route::get('/beschikbaarheid', [BeschikbaarheidController::class, 'index']);
Route::post('/get-beschikbaarheden-by-month', [BeschikbaarheidController::class, 'getBeschikbaarhedenByMonth']);
Route::post('/save-beschikbaarheid', [BeschikbaarheidController::class, 'saveBeschikbaarheid']);
Route::delete('/delete-beschikbaarheid', [BeschikbaarheidController::class, 'deleteBeschikbaarheid']);
Route::post('/create-beschikbaarheid', [BeschikbaarheidController::class, 'makeBeschikbaarheid']);

Route::resource('afspraken', AfsprakenController::class);
// Route voor het aanmaken van een afspraak
Route::post('/afspraken', [AfsprakenController::class, 'store'])->name('afspraken.store');
Route::post('/afspraken/check-availability', [AfsprakenController::class, 'checkAvailability'])->name('afspraken.checkAvailability');
Route::delete('/afspraken/{id}/annuleren', [AfsprakenController::class, 'annuleren'])->name('afspraken.annuleren');

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');

require __DIR__ . '/auth.php';