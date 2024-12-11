<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persoon;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Toon het registratieformulier.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Verwerk een nieuwe registratieaanvraag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gebruiker',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Haal een PersoonId op uit de persoon tabel
        $persoon = Persoon::first(); // Pas dit aan naar je eigen logica om een PersoonId te selecteren

        if (!$persoon) {
            return redirect()->back()->withErrors(['error' => 'Geen persoon gevonden om te koppelen aan de gebruiker.']);
        }

        $user = User::create([
            'PersoonId' => $persoon->Id, // Gebruik het opgehaalde PersoonId
            'Gebruikersnaam' => $request->name,
            'Email' => $request->email,
            'Wachtwoord' => Hash::make($request->password),
            'IsActive' => 1,
            'Isingelogd' => 0,
            'Ingelogd' => null,
            'Uitgelogd' => null,
            'Comments' => null,
            'remember_token' => Str::random(60),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}