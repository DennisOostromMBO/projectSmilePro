<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Medewerker;
use App\Models\Persoon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PraktijkmanagerController extends Controller
{
    //

    public function index()
    {
        return view("praktijkmanager.index");
    }

    public function medewerkers()
    {
        // Haal alle medewerkers op, inclusief gekoppelde persoon-data
        $medewerkers = Medewerker::with('persoon')->get();

        return view(
            "praktijkmanager.medewerkers",
            [
                "medewerkers" => $medewerkers
            ]
        );
    }

    public function edit($id)
    {
        $medewerker = Medewerker::with('persoon')->findOrFail($id);

        return view(
            "praktijkmanager.edit",
            [
                "medewerker" => $medewerker
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "voornaam" => "required|string|max:100",
            "tussenvoegsel" => "nullable|string|max:50",
            "achternaam" => "required|string|max:100",
            "geboortedatum" => [
                "required",
                "date",
                "before:" . now()->subYears(18)->format('Y-m-d'),
                "after:" . now()->subYears(100)->format('Y-m-d')
            ],
            "nummer" => "required|string|max:25",
            "medewerkertype" => "required|string|max:255",
            "specialisatie" => "required|string|max:255",
            "beschikbaarheid" => "required|string|max:255",
        ], [
            "voornaam.required" => "Voornaam is verplicht",
            "voornaam.string" => "Voornaam moet een string zijn",
            "voornaam.max" => "Voornaam mag maximaal 100 karakters bevatten",
            "tussenvoegsel.required" => "Tussenvoegsel is verplicht",
            "tussenvoegsel.string" => "Tussenvoegsel moet een string zijn",
            "tussenvoegsel.max" => "Tussenvoegsel mag maximaal 50 karakters bevatten",
            "achternaam.required" => "Achternaam is verplicht",
            "achternaam.string" => "Achternaam moet een string zijn",
            "achternaam.max" => "Achternaam mag maximaal 100 karakters bevatten",
            "geboortedatum.required" => "Geboortedatum is verplicht",
            "geboortedatum.date" => "Geboortedatum moet een datum zijn",
            "geboortedatum.before" => "De medewerker mag niet jonger zijn dan 18 jaar",
            "geboortedatum.after" => "De geboortedatum mag niet ouder zijn dan 100 jaar",
            "nummer.required" => "Nummer is verplicht",
            "nummer.string" => "Nummer moet een string zijn",
            "nummer.max" => "Nummer mag maximaal 25 karakters bevatten",
            "medewerkertype.required" => "Medewerkertype is verplicht",
            "medewerkertype.string" => "Medewerkertype moet een string zijn",
            "medewerkertype.max" => "Medewerkertype mag maximaal 255 karakters bevatten",
            "specialisatie.required" => "Specialisatie is verplicht",
            "specialisatie.string" => "Specialisatie moet een string zijn",
            "specialisatie.max" => "Specialisatie mag maximaal 255 karakters bevatten",
            "beschikbaarheid.required" => "Beschikbaarheid is verplicht",
            "beschikbaarheid.string" => "Beschikbaarheid moet een string zijn",
            "beschikbaarheid.max" => "Beschikbaarheid mag maximaal 255 karakters bevatten",
        ]);

        try {
            $medewerker = Medewerker::findOrFail($id);
            $persoon = $medewerker->persoon;

            // Update de Persoon tabel
            $persoon->update([
                'voornaam' => $validated['voornaam'],
                'tussenvoegsel' => $validated['tussenvoegsel'],
                'achternaam' => $validated['achternaam'],
                'geboortedatum' => $validated['geboortedatum'],
            ]);

            // Update de Medewerker tabel
            $medewerker->update([
                'Nummer' => $validated['nummer'],
                'Medewerkertype' => $validated['medewerkertype'],
                'Specialisatie' => $validated['specialisatie'],
                'Beschikbaarheid' => $validated['beschikbaarheid'],
            ]);

            return redirect()->route('praktijkmanager.medewerkers')->with('success', 'Medewerker succesvol bijgewerkt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het bijwerken van de medewerker.');
        }
    }

    public function create()
    {
        return view(
            "praktijkmanager.create"
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "voornaam" => "required|string|max:100",
            "tussenvoegsel" => "nullable|string|max:50",
            "achternaam" => "required|string|max:100",
            "geboortedatum" => [
                "required",
                "date",
                "before:" . now()->subYears(18)->format('Y-m-d'),
                "after:" . now()->subYears(100)->format('Y-m-d')
            ],
            "nummer" => "required|string|max:25",
            "medewerkertype" => "required|string|max:255",
            "specialisatie" => "required|string|max:255",
            "beschikbaarheid" => "required|string|max:255",
        ], [
            "voornaam.required" => "Voornaam is verplicht",
            "voornaam.string" => "Voornaam moet een string zijn",
            "voornaam.max" => "Voornaam mag maximaal 100 karakters bevatten",
            "tussenvoegsel.required" => "Tussenvoegsel is verplicht",
            "tussenvoegsel.string" => "Tussenvoegsel moet een string zijn",
            "tussenvoegsel.max" => "Tussenvoegsel mag maximaal 50 karakters bevatten",
            "achternaam.required" => "Achternaam is verplicht",
            "achternaam.string" => "Achternaam moet een string zijn",
            "achternaam.max" => "Achternaam mag maximaal 100 karakters bevatten",
            "geboortedatum.required" => "Geboortedatum is verplicht",
            "geboortedatum.date" => "Geboortedatum moet een datum zijn",
            "geboortedatum.before" => "De medewerker mag niet jonger zijn dan 18 jaar",
            "geboortedatum.after" => "De geboortedatum mag niet ouder zijn dan 100 jaar",
            "nummer.required" => "Nummer is verplicht",
            "nummer.string" => "Nummer moet een string zijn",
            "nummer.max" => "Nummer mag maximaal 25 karakters bevatten",
            "medewerkertype.required" => "Medewerkertype is verplicht",
            "medewerkertype.string" => "Medewerkertype moet een string zijn",
            "medewerkertype.max" => "Medewerkertype mag maximaal 255 karakters bevatten",
            "specialisatie.required" => "Specialisatie is verplicht",
            "specialisatie.string" => "Specialisatie moet een string zijn",
            "specialisatie.max" => "Specialisatie mag maximaal 255 karakters bevatten",
            "beschikbaarheid.required" => "Beschikbaarheid is verplicht",
            "beschikbaarheid.string" => "Beschikbaarheid moet een string zijn",
            "beschikbaarheid.max" => "Beschikbaarheid mag maximaal 255 karakters bevatten",
        ]);

        try {
            // Opslaan in de Persoon tabel
            $medewerker = Persoon::create([
                'voornaam' => $validated['voornaam'],
                'tussenvoegsel' => $validated['tussenvoegsel'],
                'achternaam' => $validated['achternaam'],
                'geboortedatum' => $validated['geboortedatum'],
            ]);

            // Haal het laatste patiëntnummer op en genereer het volgende nummer
            $lastMedewerker = Medewerker::orderBy('nummer', 'desc')->first();
            $lastMedewerkerNumber = $lastMedewerker ? $lastMedewerker->nummer : 'M000';
            $nextMedewerkerNumber = 'M' . str_pad((int)substr($lastMedewerkerNumber, 1) + 1, 3, '0', STR_PAD_LEFT);

            // Opslaan in de Patient tabel
            $medewerker = Medewerker::create([
                'PersoonId' => $medewerker->id,
                'Nummer' => $validated['nummer'],
                'Medewerkertype' => $validated['medewerkertype'],
                'Specialisatie' => $validated['specialisatie'],
                'Beschikbaarheid' => $validated['beschikbaarheid'],
            ]);

            return redirect()->route('praktijkmanager.medewerkers')->with('success', 'Medewerker succesvol aangemaakt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het aanmaken van de medewerker: ' . $e->getMessage());
        }
    }
}
