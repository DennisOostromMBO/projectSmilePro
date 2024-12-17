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
        return view('afspraken.aanmaken');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_naam' => 'required|string|max:255',
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'type_afspraak' => 'nullable|string',
        ]);

        try {
            // Verkrijg het gebruiker_id van de ingelogde gebruiker
            $gebruiker_id = auth()->id(); // Dit geeft het ID van de ingelogde gebruiker

            // Controleren of de datum niet verder dan 1 jaar in de toekomst ligt
            $datum = Carbon::parse($request->datum);
            if ($datum->diffInYears(Carbon::now()) > 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'De afspraak mag maximaal 1 jaar vooruit worden gepland.',
                ], 400);
            }

            // Tijd validatie: Controleer of het tijdstip voor 16:30 is en binnen de 30 minuten intervallen valt
            $tijd = Carbon::createFromFormat('H:i', $request->tijd);
            if ($tijd->hour > 16 || ($tijd->hour == 16 && $tijd->minute > 30)) {
                return response()->json([
                    'success' => false,
                    'message' => 'De afspraak kan alleen worden ingepland tot 16:30 uur.',
                ], 400);
            }

            // Genereer een willekeurige medewerker naam
            $medewerker_naam = $this->generateRandomMedewerkerNaam();

            Afspraak::create([
                'gebruiker_id' => $gebruiker_id,
                'patient_naam' => $request->patient_naam,
                'medewerker_naam' => $medewerker_naam,  // Genereerde medewerker naam
                'datum' => $request->datum,
                'tijd' => $request->tijd,
                'type_afspraak' => $request->type_afspraak,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Afspraak succesvol aangemaakt!',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Fout bij het opslaan van een afspraak: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Er is een fout opgetreden bij het opslaan van de afspraak.',
            ], 500);
        }
    }

    private function generateRandomMedewerkerNaam()
    {
        // Genereer een willekeurige medewerker naam
        $namen = ['Jan', 'Piet', 'Klaas', 'Sophie', 'Emma', 'David', 'Laura', 'Lars'];
        return $namen[array_rand($namen)];
    }

    // Controleren op bestaande afspraken
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
        ]);

        $afspraak = Afspraak::where('datum', $request->datum)
            ->where('tijd', $request->tijd)
            ->first();

        return response()->json(['available' => !$afspraak], 200);
    }

    public function show($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bekijken', compact('afspraak'));
    }

    public function edit($id)
    {
        $afspraak = Afspraak::findOrFail($id);
        return view('afspraken.bewerken', compact('afspraak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
            'type_afspraak' => 'nullable|string',
        ]);

        $afspraak = Afspraak::findOrFail($id);

        try {
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

    public function destroy($id)
    {
        $afspraak = Afspraak::findOrFail($id);

        try {
            $afspraak->delete();
            return response()->json(['message' => 'Afspraak succesvol verwijderd'], 200);
        } catch (\Exception $e) {
            Log::error('Fout bij het verwijderen van een afspraak: ' . $e->getMessage());
            return response()->json(['message' => 'Er is een fout opgetreden bij het verwijderen van de afspraak.'], 500);
        }
    }
}
