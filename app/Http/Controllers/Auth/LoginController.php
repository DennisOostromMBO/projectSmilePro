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
            'gebruikersnaam' => 'required|string',
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

        $credentials = $request->only('gebruikersnaam', 'password');

        // Log de ingevoerde gebruikersnaam en wachtwoord (gehasht)
        \Log::info('Ingevoerde gebruikersnaam: ' . $credentials['gebruikersnaam']);
        \Log::info('Ingevoerde wachtwoord (gehasht): ' . Hash::make($credentials['password']));

        // Log de naam van de tabel die wordt gebruikt voor de authenticatie
        \Log::info('Authenticatietabel: ' . (new User)->getTable());

        if (Auth::attempt(['Gebruikersnaam' => $credentials['gebruikersnaam'], 'password' => $credentials['password']], $request->remember)) {
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
            'gebruikersnaam' => [trans('auth.failed')],
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