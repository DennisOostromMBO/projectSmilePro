<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Afspraak;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AfsprakenController extends Controller
{  public function index()
    {
        try {
            // Haal alle afspraken op
            $afspraken = Afspraak::all();
            
            // Huidige tijd
            $now = Carbon::now();
    
            // Filter afspraken in de toekomst
            $toekomstigeAfspraken = $afspraken->filter(function($afspraak) use ($now) {
                // Starttijd van de afspraak
                $startTijd = Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd);
                
                // Eindtijd van de afspraak (30 minuten na starttijd)
                $eindTijd = $startTijd->copy()->addMinutes(30);
                
                // Als de eindtijd later is dan nu, is de afspraak toekomstig
                return $eindTijd->isAfter($now);
            });
    
            // Filter afgelopen afspraken
            $afgelopenAfspraken = $afspraken->filter(function($afspraak) use ($now) {
                // Starttijd van de afspraak
                $startTijd = Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd);
                
                // Eindtijd van de afspraak (30 minuten na starttijd)
                $eindTijd = $startTijd->copy()->addMinutes(30);
                
                // Als de eindtijd voor nu ligt, is de afspraak afgelopen
                return $eindTijd->isBefore($now);
            });
    
            // Debugging informatie toevoegen voor logging
            Log::info('Huidige tijd: ' . $now);
            foreach ($afspraken as $afspraak) {
                $startTijd = Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd);
                $eindTijd = $startTijd->copy()->addMinutes(30);
                Log::info('Afspraak ID ' . $afspraak->id . ' van ' . $startTijd . ' tot ' . $eindTijd . ' vergelijken met ' . $now);
            }
    
            // Stuur de afspraken naar de view
            return view('afspraken.index', compact('toekomstigeAfspraken', 'afgelopenAfspraken'));
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
            'patient_naam' => ['required', 'regex:/^[a-zA-Z\\s]+$/', 'max:255'],
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'type_afspraak' => 'nullable|string',
        ], [
            'patient_naam.regex' => 'De naam mag alleen letters en spaties bevatten.',
        ]);

        try {
            // Controleer op dubbele afspraak (afspraak conflict)
            $existingAppointment = Afspraak::where('datum', $request->datum)
                                           ->where('tijd', $request->tijd)
                                           ->first();

            if ($existingAppointment) {
                return redirect()->route('afspraken.create')->with('error', 'Er is al een afspraak voor dit tijdstip.');
            }

            // Controleer of de afspraak minimaal 12 uur van tevoren wordt gemaakt
            $appointmentTime = Carbon::createFromFormat('Y-m-d H:i', $request->datum . ' ' . $request->tijd);
            if ($appointmentTime->isBefore(Carbon::now()->addHours(12))) {
                return redirect()->route('afspraken.create')->with('error', 'De afspraak kan alleen minimaal 12 uur van tevoren worden gemaakt.');
            }

            // Controleer of de datum binnen de komende twee weken valt
            $datum = Carbon::parse($request->datum);
            if ($datum->isBefore(Carbon::now()->addDays(14))) {
                return redirect()->route('afspraken.create')->with('error', 'Je kunt geen afspraak maken binnen de komende twee weken.');
            }

            // Opslaan van de afspraak
            Afspraak::create([
                'patient_naam' => $request->patient_naam,
                'medewerker_naam' => $request->medewerker_naam, // Verondersteld dat deze al is gekozen
                'datum' => $request->datum,
                'tijd' => $request->tijd,
                'type_afspraak' => $request->type_afspraak,
                'gebruiker_id' => auth()->id(), // Voeg de gebruiker_id toe
            ]);

            return redirect()->route('afspraken.create')->with([
                'success' => 'Afspraak succesvol aangemaakt!',
                'timer' => true,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('afspraken.create')->with('error', 'Er is een fout opgetreden.');
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

    // Afspraak bijwerken
    public function update(Request $request, $id)
    {
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'type_afspraak' => 'nullable|string',
        ]);
    
        $afspraak = Afspraak::findOrFail($id);
    
        try {
            // Controleer of de datum en tijd in het verleden liggen
            $datumTijd = Carbon::parse($request->datum . ' ' . $request->tijd);

            // Als de nieuwe datum en tijd in het verleden liggen ten opzichte van nu, geef een foutmelding
            if ($datumTijd->isPast()) {
                return redirect()->back()->with('error', 'Je kunt geen afspraak plannen of verplaatsen naar een tijd in het verleden.');
            }
    
            // Controleren of de datum niet verder dan 1 jaar in de toekomst ligt
            $datum = Carbon::parse($request->datum);
            if ($datum->diffInYears(Carbon::now()) > 1) {
                return redirect()->back()->with('error', 'De afspraak mag maximaal 1 jaar vooruit worden gepland.');
            }
    
            // Tijd validatie: Controleer of het tijdstip voor 16:30 is en binnen de 30 minuten intervallen valt
            $tijd = Carbon::createFromFormat('H:i', $request->tijd);
            if ($tijd->hour > 16 || ($tijd->hour == 16 && $tijd->minute > 30)) {
                return redirect()->back()->with('error', 'De afspraak kan alleen worden ingepland tot 16:30 uur.');
            }
    
            // Controleer of het tijdstip al bezet is door een andere afspraak
            $existingAfspraak = DB::table('afspraken')
                ->where('datum', $request->datum)
                ->where('tijd', $request->tijd)
                ->where('id', '!=', $id) // Exclude the current afspraak
                ->first();
    
            if ($existingAfspraak) {
                return redirect()->back()->with('error', 'Het geselecteerde tijdstip is al bezet. Kies een ander tijdstip.');
            }
    
            // Update afspraak
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

    // Annuleren van een afspraak
    public function annuleren(Request $request, $id)
    {
        try {
            $afspraak = Afspraak::findOrFail($id);

            // Controleer of de annulering binnen 24 uur is
            $huidigeTijd = Carbon::now();
            $afspraakTijd = Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd);

            if ($afspraak->isBinnen24Uur()) {
                return redirect()->route('afspraken.index')->withErrors([
                    'error' => 'Het is helaas niet meer mogelijk om de afspraak te annuleren binnen 24 uur voor de geplande tijd.'
                ]);
            }

            $afspraak->delete();

            return back()->with('success', 'De afspraak is succesvol geannuleerd.');
        } catch (\Exception $e) {
            Log::error('Fout bij het annuleren van afspraak: ' . $e->getMessage());
            return back()->withErrors('Er is een fout opgetreden bij het annuleren van de afspraak.');
        }
    }
}
?>
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const nameInput = document.querySelector('input[name="patient_naam"]');
        const regex = /^[a-zA-Z\\s]+$/;

        if (!regex.test(nameInput.value)) {
            e.preventDefault();
            alert('De naam mag alleen letters en spaties bevatten.');
        }
    });
</script>
