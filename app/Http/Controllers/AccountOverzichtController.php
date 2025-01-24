<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RolModel;
use Illuminate\Support\Facades\Log;

class AccountOverzichtController extends Controller
{
    /**
     * Toon het account overzicht.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $gebruikers = User::all();
            return view('AccountOverzicht.accountoverzicht', compact('gebruikers'));
        } catch (\Exception $e) {
            Log::error('Error fetching gebruikers', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het ophalen van de gebruikers.');
        }
    }

    /**
     * Toon het formulier voor het bewerken van een gebruiker.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $rollen = RolModel::all();
            return view('AccountOverzicht.edit', compact('user', 'rollen'));
        } catch (\Exception $e) {
            Log::error('Error fetching user or roles', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het ophalen van de gebruiker of rollen.');
        }
    }

    /**
     * Werk de gebruiker bij.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Log::info('Request data', $request->all());

        $request->validate([
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|not_regex:/xn--/',
            'rol_naam' => 'required|exists:rol,Naam', // Validatie op basis van de rolnaam
        ]);

        try {
            $data = $request->all();

            $emailExists = User::where('email', $data['email'])
                ->where('id', '!=', $id)
                ->exists();

            if ($emailExists) {
                return redirect()->back()->withErrors(['email_exists' => 'Dit e-mailadres is al in gebruik!'])->withInput();
            }

            // Controleer of er maar één account is met de rol "Praktijkmanagement"
            $praktijkmanagementRol = RolModel::where('Naam', 'Praktijkmanagement')->first();
            $aantalPraktijkmanagers = User::where('rol_id', $praktijkmanagementRol->Id)->count();

            $user = User::findOrFail($id);

            if ($user->rol_id == $praktijkmanagementRol->Id && $aantalPraktijkmanagers == 1 && $data['rol_naam'] != 'Praktijkmanagement') {
                return redirect()->back()->withErrors(['rol_naam' => 'Er moet minstens één account met de rol Praktijkmanagement zijn.'])->withInput();
            }

            Log::info('Updating Gebruiker', $data);

            $user->email = $data['email'];

            // Zoek de rol op basis van de naam en stel de rol_id in
            $rol = RolModel::where('Naam', $data['rol_naam'])->first();
            $user->rol_id = $rol->Id; // Gebruik de juiste kolomnaam 'Id'

            $user->save();

            return redirect()->route('accountoverzicht.index')->with('success', 'Gebruiker bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Error updating Gebruiker', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het bijwerken van de gebruiker: ' . $e->getMessage());
        }
    }

    /**
     * Verwijder de gebruiker.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('accountoverzicht.index')->with('success', 'Gebruiker verwijderd.');
        } catch (\Exception $e) {
            Log::error('Error deleting Gebruiker', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de gebruiker: ' . $e->getMessage());
        }
    }
}