<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Exception;
use Illuminate\Support\Facades\Log;


class PatientController extends Controller
{
    public function index()
    {
        try {
            // Probeer de patiënten op te halen, inclusief de bijbehorende 'persoon' en 'contact' relaties
            $patients = Patient::with(['persoon', 'contact'])->get();

            // Retourneer de 'patient.index' view en geef de patiëntenlijst door naar de view
            return view('patient.index', compact('patients'));
        } catch (Exception $e) {
            // Als er een fout optreedt, log deze dan naar de logbestanden
            Log::error('Fout bij het ophalen van patiënten: ' . $e->getMessage());

            // Redirect de gebruiker terug naar de patiëntenindex met een foutmelding
            return redirect()->route('patients.index')->with('error', 'Er is een probleem opgetreden bij het ophalen van de patiëntenlijst.');
        }
    }
}

