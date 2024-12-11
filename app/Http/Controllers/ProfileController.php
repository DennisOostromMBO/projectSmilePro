<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.editgebruiker');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'gebruikersnaam' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gebruiker,email,' . Auth::id(),
        ]);

        $gebruiker = Auth::user();
        $gebruiker->Gebruikersnaam = $request->gebruikersnaam;
        $gebruiker->Email = $request->email;

        $gebruiker->save();

        return redirect()->route('profile.edit')->with('status', 'Profiel bijgewerkt!');
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

        if (!Hash::check($request->current_password, $gebruiker->Wachtwoord)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $gebruiker->Wachtwoord = Hash::make($request->password);
        $gebruiker->save();

        return redirect()->route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $gebruiker = Auth::user();

        if (!Hash::check($request->password, $gebruiker->Wachtwoord)) {
            return back()->withErrors(['password' => 'Password is incorrect']);
        }

        $gebruiker->delete();

        return redirect('/')->with('status', 'account-deleted');
    }
}