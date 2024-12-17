<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afspraak;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AfsprakenController extends Controller
{
    // Overzicht van alle afspraken
    public function index()
    {
        try {
            $afspraken = Afspraak::all();
            return view('afspraken.index', compact('afspraken'));
        } catch (\Exception $e) {
            Log::error('Fout bij het ophalen van afspraken: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Er is een probleem met het ophalen van de afspraken.');
        }
    }

    // Formulier voor nieuwe afspraak
    public function create()
    {
        $medewerkers = Afspraak::distinct()->pluck('medewerker_naam');  // Haal medewerkers op
        return view('afspraken.aanmaken', compact('medewerkers'));
    }

    // Opslaan van een nieuwe afspraak
    public function store(Request $request)
    {
        $request->validate([
            'patient_naam' => 'required|string|max:255',
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'type_afspraak' => 'nullable|string',
        ]);
    
        try {
            // Controleer of de datum niet verder dan 1 jaar in de toekomst ligt
            $datum = Carbon::parse($request->datum);
            if ($datum->diffInYears(Carbon::now()) > 1) {
                return redirect()->route('afspraken.create')->with('error', 'De afspraak mag maximaal 1 jaar vooruit worden gepland.');
            }
    
            // Tijd validatie: Controleer of het tijdstip voor 16:30 is en binnen de 30 minuten intervallen valt
            $tijd = Carbon::createFromFormat('H:i', $request->tijd);
            if ($tijd->hour > 16 || ($tijd->hour == 16 && $tijd->minute > 30)) {
                return redirect()->route('afspraken.create')->with('error', 'De afspraak kan alleen worden ingepland tot 16:30 uur.');
            }
    
            // Opslaan van de afspraak
            Afspraak::create([
                'patient_naam' => $request->patient_naam,
                'medewerker_naam' => $request->medewerker_naam, // Verondersteld dat deze al is gekozen
                'datum' => $request->datum,
                'tijd' => $request->tijd,
                'type_afspraak' => $request->type_afspraak,
            ]);
    
            return redirect()->route('afspraken.create')->with([
                'success' => 'Afspraak succesvol aangemaakt! je wordt doorgestuurd naar de overzicht binnen 3 seconden',
                'timer' => true, // Voeg de timer toe
            ]);
            
        } catch (\Exception $e) {
            Log::error('Fout bij het opslaan van een afspraak: ' . $e->getMessage());
            return redirect()->route('afspraken.create')->with('error', 'Er is een fout opgetreden bij het opslaan van de afspraak.');
        }
    }
    

    // Controleren op bestaande afspraken
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
        ]);
    
        $datum = Carbon::parse($request->datum);
        $tijd = Carbon::createFromFormat('H:i', $request->tijd);
    
        // Check voor afspraken in de komende twee weken
        $beginPeriode = Carbon::now()->startOfDay();
        $eindPeriode = Carbon::now()->addWeeks(2)->endOfDay();
    
        $beschikbareAfspraak = Afspraak::where('datum', '>=', $beginPeriode)
            ->where('datum', '<=', $eindPeriode)
            ->where('tijd', $tijd->format('H:i'))
            ->exists();
    
        // Als er geen afspraak is voor deze tijd, is er een beschikbaarheid
        if ($beschikbareAfspraak) {
            return response()->json(['available' => false, 'message' => 'Er zijn geen beschikbare tijdsloten in de komende twee weken.'], 200);
        }
    
        return response()->json(['available' => true], 200);
    }
    
    // Toon de details van een specifieke afspraak
    public function show($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bekijken', compact('afspraak'));
    }

    // Formulier voor het bewerken van een afspraak
    public function edit($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bewerken', compact('afspraak'));
    }

    // Bijwerken van een bestaande afspraak
    public function update(Request $request, $id)
{
    $request->validate([
        'datum' => 'required|date',
        'tijd' => 'required|date_format:H:i',
        'type_afspraak' => 'nullable|string',
    ]);

    $afspraak = Afspraak::findOrFail($id);

    try {
        // Controleer of er al een afspraak bestaat op het nieuwe tijdstip
        $existingAppointment = Afspraak::where('datum', $request->datum)
                                       ->where('tijd', $request->tijd)
                                       ->where('id', '!=', $afspraak->id) // Zorg ervoor dat de huidige afspraak niet wordt meegenomen
                                       ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'Dit tijdstip is al bezet. Kies een ander tijdstip.');
        }

        // Als het tijdstip beschikbaar is, update dan de afspraak
        $afspraak->update([
            'datum' => $request->datum,
            'tijd' => $request->tijd,
            'type_afspraak' => $request->type_afspraak,
        ]);

        return redirect()->route('afspraken.index')->with('success', 'Afspraak succesvol bijgewerkt');
    } catch (\Exception $e) {
        Log::error('Fout bij het bijwerken van een afspraak: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Er is een fout opgetreden bij het bijwerken van de afspraak.');
    }
}

    // Verwijderen van een afspraak
    public function destroy($id)
    {
        $afspraak = Afspraak::findOrFail($id);

        try {
            $afspraak->delete();
            return redirect()->route('afspraken.index')->with('success', 'Afspraak succesvol verwijderd');
        } catch (\Exception $e) {
            Log::error('Fout bij het verwijderen van een afspraak: ' . $e->getMessage());
            return redirect()->route('afspraken.index')->with('error', 'Er is een fout opgetreden bij het verwijderen van de afspraak.');
        }
    }
}
