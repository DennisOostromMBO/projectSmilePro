<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Contact;
use App\Models\Persoon;
use Illuminate\Http\Request;
use App\Repositories\PatientInfoRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
            $patients = Patient::all();

            // Stuur de gegevens naar de view
            return view('patient.index', compact('patients'));
           
        } catch (Exception $e) {
            Log::error('Fout bij het ophalen van patiëntinformatie: ' . $e->getMessage());

            // Redirect met een foutmelding
            return redirect()->route('patient.index')->with('error', 'Er is een probleem opgetreden bij het ophalen van de patiëntenlijst.');
        }
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam' => 'required|string|max:255',
            'tussenvoegsel' => 'nullable|string|max:255',
            'achternaam' => 'required|string|max:255',
            'geboortedatum' => 'required|date',
            'medisch_dossier' => 'required|string|max:255',
            'straatnaam' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'huisnummer' => 'required|digits_between:1,5',
            'postcode' => 'required|string|regex:/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/',
            'plaats' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'mobiel' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:patients,email',
        ], [
            'straatnaam.regex' => 'Straatnaam mag geen cijfers bevatten.',
            'huisnummer.required' => 'Huisnummer is verplicht.',
            'huisnummer.digits_between' => 'Huisnummer is ongeldig',
            'postcode.required' => 'Postcode is verplicht.',
            'postcode.regex' => 'Postcode is ongeldig.',
            'plaats.required' => 'Plaats is verplicht.',
            'plaats.max' => 'Plaats is te lang.',
            'plaats.regex' => 'Plaats mag geen cijfers bevatten.',
            'medisch_dossier.required' => 'Medisch dossier is verplicht.',
            'medisch_dossier.max' => 'Medisch dossier is te lang.',
        ]);

        try {
            // Opslaan in de Persoon tabel
            $persoon = Persoon::create([
                'voornaam' => $validated['voornaam'],
                'tussenvoegsel' => $validated['tussenvoegsel'],
                'achternaam' => $validated['achternaam'],
                'geboortedatum' => $validated['geboortedatum'],
            ]);

            // Haal het laatste patiëntnummer op en genereer het volgende nummer
            $lastPatient = Patient::orderBy('nummer', 'desc')->first();
            $lastPatientNumber = $lastPatient ? $lastPatient->nummer : 'P000';
            $nextPatientNumber = 'P' . str_pad((int)substr($lastPatientNumber, 1) + 1, 3, '0', STR_PAD_LEFT);

            // Opslaan in de Patient tabel
            $patient = Patient::create([
                'persoon_id' => $persoon->id,
                'medisch_dossier' => $validated['medisch_dossier'],
                'nummer' => $nextPatientNumber, // Voeg het patiëntnummer toe
            ]);

            // Voeg contactgegevens toe
            $contact = Contact::create([
                'patient_id' => $patient->id,
                'mobiel' => $validated['mobiel'],
                'email' => $validated['email'],
                'postcode' => $validated['postcode'],
                'huisnummer' => $validated['huisnummer'],
                'toevoeging' => $validated['toevoeging'],
                'plaats' => $validated['plaats'],
                'straatnaam' => $validated['straatnaam'],
            ]);

            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol aangemaakt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het aanmaken van de patiënt.');
        }
    }

    public function edit($id)
    {
        $patient = Patient::with('persoon')->findOrFail($id);
        return view('patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'voornaam' => 'required|string|max:255',
            'tussenvoegsel' => 'nullable|string|max:255',
            'achternaam' => 'required|string|max:255',
            'geboortedatum' => 'required|date',
            'medisch_dossier' => 'required|string|max:255',
            'straatnaam' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'huisnummer' => 'required|digits_between:1,5',
            'postcode' => 'required|string|regex:/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/',
            'plaats' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'mobiel' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:patients,email,' . $id,
        ], [
            'straatnaam.regex' => 'Straatnaam mag geen cijfers bevatten.',
            'huisnummer.required' => 'Huisnummer is verplicht.',
            'huisnummer.digits_between' => 'Huisnummer is ongeldig',
            'postcode.required' => 'Postcode is verplicht.',
            'postcode.regex' => 'Postcode is ongeldig.',
            'plaats.required' => 'Plaats is verplicht.',
            'plaats.max' => 'Plaats is te lang.',
            'plaats.regex' => 'Plaats mag geen cijfers bevatten.',
            'medisch_dossier.required' => 'Medisch dossier is verplicht.',
            'medisch_dossier.max' => 'Medisch dossier is te lang.',
        ]);

        try {
            $patient = Patient::findOrFail($id);
            $persoon = $patient->persoon;

            // Update de Persoon tabel
            $persoon->update([
                'voornaam' => $validated['voornaam'],
                'tussenvoegsel' => $validated['tussenvoegsel'],
                'achternaam' => $validated['achternaam'],
                'geboortedatum' => $validated['geboortedatum'],
            ]);

            // Update de Patient tabel
            $patient->update([
                'medisch_dossier' => $validated['medisch_dossier'],
                'straatnaam' => $validated['straatnaam'],
                'huisnummer' => $validated['huisnummer'],
                'toevoeging' => $request->input('toevoeging'),
                'postcode' => $validated['postcode'],
                'plaats' => $validated['plaats'],
                'mobiel' => $validated['mobiel'],
                'email' => $validated['email'],
            ]);

            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol bijgewerkt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het bijwerken van de patiënt.');
        }
    }

    public function destroy($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $patient->delete();

            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol verwijderd.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de patiënt.');
        }
    }
}