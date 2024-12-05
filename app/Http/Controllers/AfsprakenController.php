<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afspraak;
use Illuminate\Support\Facades\Validator;

class AfsprakenController extends Controller
{
    // Overzicht van alle afspraken
    public function index()
    {
        try {
            $afspraken = Afspraak::all();
            return view('afspraken.index', compact('afspraken'));
        } catch (\Exception $e) {
            \Log::error('Fout bij het ophalen van afspraken: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Er is een probleem met het ophalen van de afspraken.');
        }
    }

    // Formulier voor nieuwe afspraak
    public function create()
    {
        return view('afspraken.aanmaken');
    }

    public function store(Request $request)
{
    $request->validate([
        'gebruiker_id' => 'required|exists:gebruikers,id',
        'datum' => 'required|date',
        'tijd' => 'required|date_format:H:i',
        'notities' => 'nullable|string',
    ]);
    

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        Afspraak::create([
            'datum' => $request->datum,
            'tijd' => $request->tijd,
            'notities' => $request->notities,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Afspraak succesvol aangemaakt!',
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Fout bij het opslaan van een afspraak: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Er is een fout opgetreden bij het opslaan van de afspraak.',
        ], 500);
    }
}

    

    // Controleren op bestaande afspraken (AJAX)
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
        ]);

        $afspraak = Afspraak::where('datum', $request->datum)
            ->where('tijd', $request->tijd)
            ->first();

        if ($afspraak) {
            return response()->json(['available' => false], 200);
        }

        return response()->json(['available' => true], 200);
    }

    // Bekijken van een specifieke afspraak
    public function show($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bekijken', compact('afspraak'));
    }

    // Formulier voor bewerken van afspraak
    public function edit($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bewerken', compact('afspraak'));
    }

    // Opslaan van wijzigingen
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'notities' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $afspraak = Afspraak::findOrFail($id);

        try {
            $afspraak->update($request->all());
            return response()->json(['message' => 'Afspraak succesvol bijgewerkt'], 200);
        } catch (\Exception $e) {
            \Log::error('Fout bij het bijwerken van een afspraak: ' . $e->getMessage());
            return response()->json(['message' => 'Er is een fout opgetreden bij het bijwerken van de afspraak.'], 500);
        }
    }

    // Verwijderen van een afspraak
    public function destroy($id) 
    {
        $afspraak = Afspraak::findOrFail($id);

        try {
            $afspraak->delete();
            return response()->json(['message' => 'Afspraak succesvol verwijderd'], 200);
        } catch (\Exception $e) {
            \Log::error('Fout bij het verwijderen van een afspraak: ' . $e->getMessage());
            return response()->json(['message' => 'Er is een fout opgetreden bij het verwijderen van de afspraak.'], 500);
        }
    }
}
