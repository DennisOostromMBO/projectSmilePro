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

    public function edit(Request $request, $id)
    {
        $patient = Patient::with(['persoon', 'contact'])->find($id);
        return view('patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        // Validatie van de requestgegevens buiten de try-catch
        $validatedData = $request->validate([
            // Persoonlijke gegevens
            'Voornaam' => 'required|string|max:255',
            'Tussenvoegsel' => 'nullable|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Geboortedatum' => 'required|date',
            'Mobiel' => 'required|regex:/^\+?[1-10]\d{1,14}$/', 
            'Email' => 'required|email|max:255',
            'MedischDossier' => 'nullable|string',
            'Straatnaam' => 'required|string|max:255',
            'Huisnummer' => 'required|numeric|digits_between:1,4',
            'Toevoeging' => 'nullable|string|max:10',
            'Postcode' => 'required|string|max:10',
            'Plaats' => 'required|string|max:255',
        ], [
            'Voornaam.required' => 'Het veld Voornaam is verplicht.',
            'Voornaam.max' => 'De Voornaam mag niet langer zijn dan 255 tekens.',
            'Achternaam.required' => 'Het veld Achternaam is verplicht.',
            'Achternaam.max' => 'De Achternaam mag niet langer zijn dan 255 tekens.',
            'Email.required' => 'Het veld E-mailadres is verplicht.',
            'Email.email' => 'Het opgegeven E-mailadres is ongeldig.',
            'Email.max' => 'Het E-mailadres mag niet langer zijn dan 255 tekens.',
            'Mobiel.required' => 'Het veld mobielnummer is verplicht.',
            'Mobiel.regex' => 'Het mobiele nummer heeft een ongeldig formaat.',
            'Straatnaam.required' => 'Het veld Straatnaam is verplicht.',
            'Straatnaam.max' => 'De Straatnaam mag niet langer zijn dan 255 tekens.',
            'Huisnummer.required' => 'Het veld Huisnummer is verplicht.',
            'Huisnummer.numeric' => 'Het Huisnummer moet een geldig nummer zijn.',
            'Huisnummer.digits_between' => 'Het Huisnummer moet tussen de 1 en 4 cijfers bevatten.',
            'Postcode.required' => 'Het veld Postcode is verplicht.',
            'Postcode.max' => 'De Postcode mag niet langer zijn dan 10 tekens.',
            'Plaats.required' => 'Het veld Plaats is verplicht.',
            'Plaats.max' => 'De Plaats mag niet langer zijn dan 255 tekens.',
            'MedischDossier.max' => 'Het Medisch Dossier mag niet langer zijn dan 1000 tekens.',
        ]);
    
        // Begin van de try-catch voor database-interacties en andere logica
        try {
            Log::info('Gevalideerde gegevens ontvangen:', $validatedData);
    
            // Ophalen van de patiënt
            $patient = Patient::findOrFail($id);
            Log::info('Opgehaalde patiënt:', $patient->toArray());
    
            // Ophalen van gekoppelde persoon en contact
            $persoon = $patient->persoon;
            $contact = $patient->contact;
    
            Log::info('Persoon gekoppeld aan patiënt:', $persoon->toArray());
            Log::info('Contact gekoppeld aan patiënt:', $contact->toArray());
    
            // Update gegevens voor Persoon en Contact
            $persoon->Voornaam = $validatedData['Voornaam'];
            $persoon->Tussenvoegsel = $validatedData['Tussenvoegsel'];
            $persoon->Achternaam = $validatedData['Achternaam'];
            $persoon->Geboortedatum = $validatedData['Geboortedatum'];
            Log::info('Persoon vóór save:', $persoon->toArray());
            $persoon->save();
    
            $contact->Straatnaam = $validatedData['Straatnaam'];
            $contact->Huisnummer = $validatedData['Huisnummer'];
            $contact->Toevoeging = $validatedData['Toevoeging'];
            $contact->Postcode = $validatedData['Postcode'];
            $contact->Plaats = $validatedData['Plaats'];
            $contact->Mobiel = $validatedData['Mobiel'];
            $contact->Email = $validatedData['Email'];
            Log::info('Contact vóór save:', $contact->toArray());
            $contact->save();
    
            // Update MedischDossier
            $patient->MedischDossier = $validatedData['MedischDossier'];
            Log::info('MedischDossier vóór save:', $patient->toArray());
            $patient->save();
    
            // Loggen van de veranderingen
            Log::info('Persoon na save:', Persoon::find($persoon->Id)->toArray());
            Log::info('Contact na save:', Contact::find($contact->Id)->toArray());
            Log::info("Patient PersoonId voor update: " . $patient->PersoonId);
            Log::info('Validatiegegevens:', $validatedData);
    
            Log::info('Persoon was changed:', ['changed' => $persoon->wasChanged()]);
            Log::info('Contact was changed:', ['changed' => $contact->wasChanged()]);
            Log::info('Patient was changed:', ['changed' => $patient->wasChanged()]);
    
            if (!$persoon->wasChanged()) {
                Log::info('Geen wijzigingen voor Persoon.');
            }
    
            if (!$contact->wasChanged()) {
                Log::info('Geen wijzigingen voor Contact.');
            }
    
            if (!$patient->wasChanged()) {
                Log::info('Geen wijzigingen voor Patient.');
            }
    
            // Redirect naar de indexpagina met een succesbericht
            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol bijgewerkt.');
    
        } catch (\Exception $e) {
            Log::error('Fout bij updaten van patiënt:', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            // Als er een fout optreedt, ga terug naar de edit-pagina met de foutmelding
            return redirect()->route('patient.edit', $id)
                ->withErrors($e->getMessage())
                ->withInput(); // Zorgt ervoor dat de ingevulde gegevens behouden blijven
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
            'telefoonnummer' => 'required|string|max:15',
            'email' => 'required|email',
            'postcode' => 'required|string|max:10',
            'huisnummer' => 'required|string|max:10',
            'plaats' => 'required|string|max:255',
            'toevoeging' => 'nullable|string|max:10',
            'straatnaam' => 'required|string|max:255',
            'medisch_dossier' => 'required|string',
        ]);
    
        // Opslaan in de Persoon tabel
        $persoon = Persoon::create([
            'voornaam' => $validated['voornaam'],
            'tussenvoegsel' => $validated['tussenvoegsel'],
            'achternaam' => $validated['achternaam'],
            'geboortedatum' => $validated['geboortedatum'],
        ]);

        //Dit haalt eerst het laatste nummer op, dan start die vanaf P000 en loopt die telkens hoger op.
        $lastPatient = Patient::orderBy('Nummer', 'desc')->first(); 
        $lastPatientNumber = $lastPatient ? $lastPatient->patientnummer : 'P000'; 
        $nextPatientNumber = 'P' . str_pad((int)substr($lastPatientNumber, 1) + 1, 3, '0', STR_PAD_LEFT);
    
        // Opslaan in de Patient tabel
        $patient = Patient::create([
            'persoon_id' => $persoon->id,
            'medisch_dossier' => $validated['medisch_dossier'],
        ]);
    
        // Opslaan in de Contact tabel
        $contact = Contact::create([
            'patient_id' => $patient->id,
            'telefoonnummer' => $validated['telefoonnummer'],
            'email' => $validated['email'],
            'postcode' => $validated['postcode'],
            'huisnummer' => $validated['huisnummer'],
            'plaats' => $validated['plaats'],
            'toevoeging' => $validated['toevoeging'],
            'straatnaam' => $validated['straatnaam'],
        ]);
    
        // Redirect naar de patiënt overzicht pagina
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol toegevoegd!');
    }
    
}
