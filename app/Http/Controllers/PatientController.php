<?php

namespace App\Http\Controllers;

use App\Repositories\PatientInfoRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    protected $patientInfoRepository;

    public function __construct(PatientInfoRepository $patientInfoRepository)
    {
        $this->patientInfoRepository = $patientInfoRepository;
    }

    public function index()
{
    try {
        // Haal de gegevens op via de repository
        $patients = $this->patientInfoRepository->getPatientInfo();

        // Stuur de gegevens naar de view
        return view('patient.index', compact('patients'));
    } catch (Exception $e) {
        Log::error('Fout bij het ophalen van patiëntinformatie: ' . $e->getMessage());

        // Redirect met een foutmelding
        return redirect()->route('patient.index')->with('error', 'Er is een probleem opgetreden bij het ophalen van de patiëntenlijst.');
    }
}

}

