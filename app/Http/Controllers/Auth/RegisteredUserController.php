<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PersoonModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create a new persoon record
        $persoon = PersoonModel::create([
            'VolledigeNaam' => $request->name, // Store the full name
            'Geboortedatum' => '2010-05-12', // Set the birth date to 12-5-2010
            'IsActive' => true,
            'Comments' => null,
        ]);

        $currentTime = Carbon::now();

        // Create a new user record
        $user = User::create([
            'persoon_id' => $persoon->id, 
            'rol_id' => 6, 
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'IsActive' => 1,
            'Isingelogd' => 0,
            'Ingelogd' => $currentTime,
            'Uitgelogd' => $currentTime,
            'Comments' => null,
            'remember_token' => Str::random(60),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
