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
use Illuminate\Pagination\LengthAwarePaginator;

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
            // Haal gegevens op uit de repository
            $patientsCollection = $this->patientInfoRepository->getPatientInfo();

            // Pagination
            // Haal de huidige pagina op uit de querystring of gebruik standaardpagina 1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Stel het aantal items per pagina in
            $perPage = 5;
            // Bereken de items die op de huidige pagina moeten worden weergegeven
            // 'slice' wordt gebruikt om een subset van de verzameling ($patientsCollection) te maken.
            // ($currentPage - 1) * $perPage berekent de startindex van de huidige pagina
            $currentItems = $patientsCollection->slice(($currentPage - 1) * $perPage, $perPage);
            // Maak een nieuwe LengthAwarePaginator instantie om de gegevens te beheren
            $patients = new LengthAwarePaginator(
                $currentItems, // De items voor de huidige pagina
                $patientsCollection->count(),  // Totaal aantal items in de collectie
                $perPage, // Aantal items per pagina
                $currentPage, // Huidige pagina
                [
                    'path' => request()->url(), // URL voor de paginering-links
                    'query' => request()->query()
                ] // Query-parameters (zoals filters) opnemen in de paginering-links
            );

            // Stuur de gegevens naar de view
            return view('patient.index', compact('patients'));
        } catch (Exception $e) {
            // Log de fout voor debugging
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

    public function update(Request $request, $id) // Voor edit
    {
        $contact = Contact::findOrFail($id);

        // Controleer of e-mail al bestaat, maar sla de huidige patiënt uit de check uit
        $emailExists = Contact::where('Email', $request->input('Email'))
            ->where('Id', '!=', $contact->Id) // Uitsluiten van de huidige record
            ->exists();

        // Controleer of mobielnummer al bestaat, maar sla de huidige patiënt uit de check uit
        $mobielExists = Contact::where('Mobiel', $request->input('Mobiel'))
            ->where('Id', '!=', $contact->Id) // Uitsluiten van de huidige record
            ->exists();

        // Als e-mail al bestaat, geef een foutmelding weer
        if ($emailExists) {
            return redirect()->back()->withErrors(['email_exists' => 'Patiënt bestaat al in het systeem, dubbel e-mailadres!'])->withInput();
        }

        // Als mobielnummer al bestaat, geef een foutmelding weer
        if ($mobielExists) {
            return redirect()->back()->withErrors(['mobiel_exists' => 'Patiënt bestaat al in het systeem, dubbel mobielnummer!'])->withInput();
        }

        // Validatie van de invoervelden
        $validatedData = $request->validate([
            'Voornaam' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'Tussenvoegsel' => 'nullable|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'Achternaam' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'Geboortedatum' => 'required|date|after_or_equal:1900-01-01|before:today',
            'Mobiel' => 'required|regex:/^06\d{8}$/',
            'Email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|not_regex:/xn--/',
            'MedischDossier' => 'max:1000',
            'Straatnaam' => 'required|string|max:255|regex:/^[^\d]+$/',
            'Huisnummer' => 'required|regex:/^\d+$/|digits_between:1,4',
            'Toevoeging' => 'nullable|string|max:8',
            'Postcode' => 'required|regex:/^[0-9]{4}[A-Z]{2}$/',
            'Plaats' => 'required|string|max:255|regex:/^[^\d]+$/',
        ], [
            // Voornaam
            'Voornaam.required' => 'Voornaam is verplicht.',
            'Voornaam.max' => 'Voornaam is te lang.',
            'Voornaam.regex' => 'Voornaam is ongeldig',

            // Tussenvoegsel
            'Tussenvoegsel.max' => 'Tussenvoegsel is te lang.',
            'Tussenvoegsel.regex' => 'Tussenvoegsel is ongeldig',

            // Achternaam
            'Achternaam.required' => 'Achternaam is verplicht.',
            'Achternaam.max' => 'Achternaam is te lang.',
            'Achternaam.regex' => 'Achternaam is ongeldig',

            // Geboortedatum
            'Geboortedatum.required' => 'Geboortedatum is verplicht.',
            'Geboortedatum.date' => 'Geboortedatum is geen geldige datum.',
            'Geboortedatum.after_or_equal' => 'Geboortedatum is niet geldig.',
            'Geboortedatum.before' => 'Geboortedatum is niet geldig.',

            // E-mailadres
            'Email.required' => 'E-mailadres is verplicht.',
            'Email.email' => 'E-mailadres is ongeldig.',
            'Email.max' => 'E-mailadres is te lang.',
            'Email.regex' => 'E-mailadres is ongeldig.',
            'Email.not_regex' => 'E-mailadres is ongeldig.',

            // Mobielnummer
            'Mobiel.required' => 'Mobielnummer is verplicht.',
            'Mobiel.regex' => 'Mobielnummer is ongeldig.',
            'Mobiel.unique' => 'Dit mobielnummer is al in gebruik.',

            // Toevoeging
            'Toevoeging.max' => 'Toevoeging is niet geldig.',

            // Straatnaam
            'Straatnaam.required' => 'Straatnaam is verplicht.',
            'Straatnaam.max' => 'Straatnaam is te lang.',
            'Straatnaam.regex' => 'Straatnaam is ongeldig.',

            // Huisnummer
            'Huisnummer.required' => 'Huisnummer is verplicht.',
            'Huisnummer.regex' => 'Huisnummer mag alleen cijfers bevatten.',
            'Huisnummer.digits_between' => 'Huisnummer is ongeldig.',

            // Postcode
            'Postcode.required' => 'Postcode is verplicht.',
            'Postcode.regex' => 'Postcode is ongeldig.',

            // Plaats
            'Plaats.required' => 'Plaats is verplicht.',
            'Plaats.max' => 'Plaats is te lang.',
            'Plaats.regex' => 'Plaats is ongeldig.',

            // Medisch dossier
            'MedischDossier.max' => 'Medisch dossier is te lang.',
        ]);


        // Log de gevalideerde gegevens
        Log::info('Gevalideerde gegevens ontvangen:', $validatedData);

        try {
            echo ("Ik ben try van save");

            // Ophalen van de patiënt en bijbehorende gegevens
            $patient = Patient::with(['persoon', 'contact'])->findOrFail($id);
            Log::info('Opgehaalde patiënt:', $patient->toArray());
            $persoon = $patient->persoon;
            $contact = $patient->contact;

            // Update de gegevens voor Persoon
            $persoon->Voornaam = $validatedData['Voornaam'];
            $persoon->Tussenvoegsel = $validatedData['Tussenvoegsel'];
            $persoon->Achternaam = $validatedData['Achternaam'];
            $persoon->Geboortedatum = $validatedData['Geboortedatum'];
            $persoon->save();

            // Update de gegevens voor Contact
            $contact->Straatnaam = $validatedData['Straatnaam'];
            $contact->Huisnummer = $validatedData['Huisnummer'];
            $contact->Toevoeging = $validatedData['Toevoeging'];
            $contact->Postcode = $validatedData['Postcode'];
            $contact->Plaats = $validatedData['Plaats'];
            $contact->Mobiel = $validatedData['Mobiel'];
            $contact->Email = $validatedData['Email'];
            $contact->save();

            // Update MedischDossier
            $patient->MedischDossier = $validatedData['MedischDossier'];
            $patient->save();

            // Log de wijzigingen na het opslaan
            Log::info('Persoon na save:', Persoon::find($persoon->Id)->toArray());
            Log::info('Contact na save:', Contact::find($contact->Id)->toArray());
            Log::info('Patient na save:', Patient::find($patient->Id)->toArray());

            // Controleer of er daadwerkelijk wijzigingen zijn
            if ($persoon->wasChanged() || $contact->wasChanged()) {
                Log::info('Updated values:', [
                    'Voornaam' => $persoon->Voornaam,
                    'Achternaam' => $persoon->Achternaam,
                    'Mobiel' => $contact->Mobiel,
                    'Straatnaam' => $contact->Straatnaam,
                ]);
            } else {
                Log::info('Geen wijzigingen in Persoon of Contact.');
            }

            // Redirect naar de indexpagina met een succesbericht
            return redirect()->route('patient.index')->with('success', 'Patiënt succesvol bijgewerkt.');
        } catch (\Exception $e) {
            Log::error('Fout bij het updaten van patiënt:', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect naar de editpagina met de foutmelding
            return redirect()->route('patient.edit', $id)
                ->withErrors('Er is een fout opgetreden bij het bijwerken van de gegevens.')
                ->withInput(); // Zorgt ervoor dat de ingevulde gegevens behouden blijven
        }
    }




    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request) // voor create
    {
        // Controleer of e-mail of mobiel al bestaat
        $emailExists = Contact::where('Email', $request->input('email'))->exists();
        $mobielExists = Contact::where('Mobiel', $request->input('mobiel'))->exists();

        // Als e-mail of mobiel al bestaat, geef een foutmelding weer bovenaan de pagina
        if ($emailExists) {
            return redirect()->back()->withErrors(['email_exists' => 'Patiënt bestaat al in het systeem, dubbel e-mailadres!'])->withInput();
        }

        if ($mobielExists) {
            return redirect()->back()->withErrors(['mobiel_exists' => 'Patiënt bestaat al in het systeem, dubbel mobielnummer!'])->withInput();
        }

        // Validatie van de invoervelden
        $validated = $request->validate([
            'voornaam' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'tussenvoegsel' => 'nullable|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'achternaam' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\- ]+$/u',
            'geboortedatum' => 'required|date|after_or_equal:1900-01-01|before:today',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|not_regex:/xn--/',
            'postcode' => 'required|regex:/^[0-9]{4}[A-Z]{2}$/',
            'huisnummer' => 'required|regex:/^\d+$/|digits_between:1,4',
            'plaats' => 'required|string|max:255|regex:/^[^\d]+$/',
            'toevoeging' => 'nullable|string|max:8',
            'straatnaam' => 'required|string|max:255|regex:/^[^\d]+$/',
            'medisch_dossier' => 'max:1000|',
            'mobiel' => 'regex:/^06\d{8}$/|unique:contact,Mobiel',
        ], [
            // Voornaam
            'voornaam.required' => 'Voornaam is verplicht.',
            'voornaam.max' => 'Voornaam is te lang.',
            'voornaam.regex' => 'Voornaam is ongeldig',

            // Tussenvoegsel
            'tussenvoegsel.max' => 'Tussenvoegsel is te lang.',
            'tussenvoegsel.regex' => 'Tussenvoegsel is ongeldig.',

            // Achternaam
            'achternaam.required' => 'Achternaam is verplicht.',
            'achternaam.max' => 'Achternaam is te lang.',
            'achternaam.regex' => 'Achternaam is ongeldig.',

            // Geboortedatum
            'geboortedatum.required' => 'Geboortedatum is verplicht.',
            'geboortedatum.date' => 'Geboortedatum is geen geldige datum.',
            'geboortedatum.after_or_equal' => 'Geboortedatum is niet geldig.',
            'geboortedatum.before' => 'Geboortedatum is niet geldig.',

            // E-mailadres
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'E-mailadres is ongeldig.',
            'email.max' => 'E-mailadres is te lang.',
            'email.regex' => 'E-mailadres is ongeldig.',
            'email.not_regex' => 'E-mailadres is ongeldig.',

            // Mobielnummer
            'mobiel.required' => 'Mobielnummer is verplicht.',
            'mobiel.regex' => 'Mobielnummer is ongeldig',
            'mobiel.unique' => 'Dit mobielnummer is al in gebruik.',

            // Toevoeging
            'toevoeging.max' => 'Toevoeging is niet geldig.',

            // Straatnaam
            'straatnaam.required' => 'Straatnaam is verplicht.',
            'straatnaam.max' => 'Straatnaam is te lang.',
            'straatnaam.regex' => 'Straatnaam is ongeldig.',

            // Huisnummer
            'huisnummer.required' => 'Huisnummer is verplicht.',
            'huisnummer.regex' => 'Huisnummer is ongeldig.',
            'huisnummer.digits_between' => 'Huisnummer is ongeldig',

            // Postcode
            'postcode.required' => 'Postcode is verplicht.',
            'postcode.regex' => 'Postcode is ongeldig.',

            // Plaats
            'plaats.required' => 'Plaats is verplicht.',
            'plaats.max' => 'Plaats is te lang.',
            'plaats.regex' => 'Plaats is ongeldig.',

            // Medisch dossier
            'medisch_dossier.max' => 'Medisch dossier is te lang.',
        ]);


        try {
            // Opslaan in de Persoon tabel
            $persoon = Persoon::create([
                'Voornaam' => $validated['voornaam'],
                'Tussenvoegsel' => $validated['tussenvoegsel'],
                'Achternaam' => $validated['achternaam'],
                'Geboortedatum' => $validated['geboortedatum'],
            ]);

            // Haal het laatste patiëntnummer op en genereer het volgende nummer
            $lastPatient = Patient::orderBy('Nummer', 'desc')->first();
            $lastPatientNumber = $lastPatient ? $lastPatient->Nummer : 'P000';
            $nextPatientNumber = 'P' . str_pad((int)substr($lastPatientNumber, 1) + 1, 3, '0', STR_PAD_LEFT);

            // Opslaan in de Patient tabel
            $patient = Patient::create([
                'PersoonId' => $persoon->Id,
                'MedischDossier' => $validated['medisch_dossier'],
                'Nummer' => $nextPatientNumber, // Voeg het patiëntnummer toe
            ]);

            // Voeg contactgegevens toe
            $contact = Contact::create([
                'PatientId' => $patient->Id,
                'Mobiel' => $validated['mobiel'],
                'Email' => $validated['email'],
                'Postcode' => $validated['postcode'],
                'Huisnummer' => $validated['huisnummer'],
                'Toevoeging' => $validated['toevoeging'],
                'Plaats' => $validated['plaats'],
                'Straatnaam' => $validated['straatnaam'],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Fout bij opslaan gegevens: ' . $e->getMessage()])->withInput();
        }

        // Redirect naar de patiënt overzicht pagina
        return redirect()->route('patient.index')->with('success', 'Patiënt succesvol toegevoegd!');
    }

    public function destroy($id)
    {
        try {
            // Controleer of het medisch dossier leeg is
            $patient = DB::table('patient')->where('id', $id)->first();

            if (!$patient) {
                Log::error('Patiënt niet gevonden.', ['id' => $id]);
                return redirect()->route('patient.index')
                    ->with('error', 'Patiënt niet gevonden.');
            }

            if (!empty($patient->MedischDossier)) {
                Log::error('Medisch dossier is niet leeg.', ['id' => $id, 'MedischDossier' => $patient->MedischDossier]);
                return redirect()->route('patient.index')
                    ->with('error', 'De patiënt kan niet worden verwijderd omdat het medisch dossier niet leeg is.');
            }

            // Roep de opgeslagen procedure aan
            DB::statement('CALL spDeletePatient(?)', [$id]);

            Log::info('Patiënt succesvol verwijderd.', ['id' => $id]);
            return redirect()->route('patient.index')
                ->with('success', 'Patiënt succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Fout bij het verwijderen van de patiënt.', [
                'id' => $id,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('patient.index')
                ->with('error', 'Er is een fout opgetreden bij het verwijderen van de patiënt: ' . $e->getMessage());
        }
    }
}