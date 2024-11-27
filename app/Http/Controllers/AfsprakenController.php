<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afspraak;

class AfsprakenController extends Controller
{
    // Overzicht van alle afspraken
    public function index()
    {
        $afspraken = Afspraak::all();
        return view('afspraken.index', compact('afspraken'));
    }

    // Formulier voor nieuwe afspraak
    public function create()
    {
        return view('afspraken.aanmaken');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'gebruiker_id' => 'required',
            'datum' => 'required|date',
            'tijd' => 'required',
            'notities' => 'nullable|string'
        ]);
    
        Afspraak::create($validated);
        return response()->json(['message' => 'Afspraak succesvol opgeslagen']);
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
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required',
            'notities' => 'nullable|string',
        ]);

        $afspraak = Afspraak::findOrFail($id);
        $afspraak->update($request->all());

        return redirect()->route('afspraken.index')->with('success', 'Afspraak succesvol bijgewerkt.');
    }

    // Verwijderen van een afspraak
    public function destroy($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        $afspraak->delete();

        return redirect()->route('afspraken.index')->with('success', 'Afspraak succesvol verwijderd.');
    }
}
