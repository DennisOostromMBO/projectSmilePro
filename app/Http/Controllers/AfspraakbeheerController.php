<?php

// app/Http/Controllers/AfspraakbeheerController.php

namespace App\Http\Controllers;

use App\Models\Afspraakbeheer;
use Illuminate\Http\Request;

class AfspraakbeheerController extends Controller
{
    // Je kan de methodes hier hernoemen en aanpassen naar het nieuwe model
    public function store(Request $request)
    {
        // Validatie van invoer
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'datum' => 'required|date',
            'tijd' => 'required|date_format:H:i',
        ]);

        // Opslaan van de afspraak in de database
        $afspraak = Afspraakbeheer::create([
            'patient_id' => $request->patient_id,
            'datum' => $request->datum,
            'tijd' => $request->tijd,
            'status' => 'Bevestigd', // Of gebruik de gewenste status
            'is_active' => true,
            'comments' => $request->comments,
        ]);

        // Bevestigingsbericht teruggeven
        return redirect()->back()->with('success', 'Afspraak succesvol ingepland voor ' . $afspraak->datum . ' om ' . $afspraak->tijd . '.');
    }

    public function index()
    {
        // Ophalen van beschikbare afspraken
        $afspraken = Afspraakbeheer::where('is_active', true)->orderBy('datum')->orderBy('tijd')->get();

        return view('patient.afspraakbeheer', compact('afspraken'));
    }
}

?>