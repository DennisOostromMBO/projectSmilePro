<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.editgebruiker', [
            'gebruiker' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Gebruik dd om de inhoud van de request te dumpen en te stoppen
        dd($request->all());

        $user = Auth::user();

        $request->validate([
            'gebruikersnaam' => ['nullable', 'string', 'max:255', Rule::unique('gebruiker')->ignore($user->id)],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('gebruiker')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->filled('gebruikersnaam')) {
            $user->Gebruikersnaam = $request->name;
        }

        if ($request->filled('email')) {
            $user->Email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profiel succesvol bijgewerkt!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $gebruiker = Auth::user();

        if (!Hash::check($request->current_password, $gebruiker->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $gebruiker->password = Hash::make($request->password);
        $gebruiker->save();

        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Account deletion logic
    }
}