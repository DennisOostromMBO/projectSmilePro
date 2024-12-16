<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Controleer de databaseverbinding
        try {
            DB::connection()->getPdo();
            \Log::info('Databaseverbinding succesvol.');
        } catch (\Exception $e) {
            \Log::error('Geen verbinding met de database: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Geen verbinding met de database.');
        }

        $credentials = $request->only('email', 'password');

        // Log de ingevoerde email en wachtwoord (gehasht)
        \Log::info('Ingevoerde email: ' . $credentials['email']);
        \Log::info('Ingevoerde wachtwoord (gehasht): ' . Hash::make($credentials['password']));

        // Log de naam van de tabel die wordt gebruikt voor de authenticatie
        \Log::info('Authenticatietabel: ' . (new User)->getTable());

        if (Auth::attempt(['Email' => $credentials['email'], 'password' => $credentials['password']], $request->remember)) {
            $request->session()->regenerate();

            // Haal de ingelogde gebruiker op
            $user = Auth::user();

            // Log de gegevens van de ingelogde gebruiker
            \Log::info('Ingelogde gebruikersnaam: ' . $user->Gebruikersnaam);
            \Log::info('Ingelogde email: ' . $user->Email);
            \Log::info('Ingelogde PersoonId: ' . $user->PersoonId);

            // Stuur door naar het dashboard
            return redirect()->intended('dashboard');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}