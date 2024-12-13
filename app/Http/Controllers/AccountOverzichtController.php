<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GebruikerModel;
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
            // Haal alle gebruikers op met hun bijbehorende persoon gegevens
            $gebruikers = GebruikerModel::with('persoon')->get();
            return view('Accountoverzicht.accountoverzicht', compact('gebruikers'));
        } catch (\Exception $e) {
            // Log de fout en toon een foutmelding aan de gebruiker
            Log::error('Fout bij het ophalen van gebruikers: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het ophalen van de gebruikers.');
        }
    }
}