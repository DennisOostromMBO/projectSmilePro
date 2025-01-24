<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Medewerker;
use App\Models\Persoon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PraktijkmanagerController extends Controller
{
    public function medewerkers()
    {
        $medewerkers = Medewerker::with('persoon')->paginate(15);

        if ($medewerkers->isEmpty()) {
            return redirect()->route('praktijkmanager.medewerkers');
        }

        return view('praktijkmanager.medewerkers', [
            'medewerkers' => $medewerkers
        ]);
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
            "contractverloopdatum" => "required|date",
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
            "contractverloopdatum.required" => "Contractverloopdatum is verplicht",
            "contractverloopdatum.date" => "Contractverloopdatum moet een datum zijn",
        ]);

        // dd($validated);

        try {
            $medewerker = Medewerker::findOrFail($id);
            $persoon = $medewerker->persoon;

            // Update de Persoon tabel
            $persoon->update([
                'Voornaam' => $validated['voornaam'],
                'Tussenvoegsel' => $validated['tussenvoegsel'],
                'Achternaam' => $validated['achternaam'],
                'Geboortedatum' => $validated['geboortedatum'],
            ]);

            // Update de Medewerker tabel
            $medewerker->update([
                'Nummer' => $validated['nummer'],
                'Medewerkertype' => $validated['medewerkertype'],
                'Specialisatie' => $validated['specialisatie'],
                'Beschikbaarheid' => $validated['beschikbaarheid'],
                'ContractVerloopdatum' => $validated['contractverloopdatum'],
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
            "contractverloopdatum" => "required|date",
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
            "contractverloopdatum.required" => "Contractverloopdatum is verplicht",
            "contractverloopdatum.date" => "Contractverloopdatum moet een datum zijn",
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
            // $lastMedewerker = Medewerker::orderBy('nummer', 'desc')->first();
            // $lastMedewerkerNumber = $lastMedewerker ? $lastMedewerker->nummer : 'M000';
            // $nextMedewerkerNumber = 'M' . str_pad((int)substr($lastMedewerkerNumber, 1) + 1, 3, '0', STR_PAD_LEFT);

            // Opslaan in de Patient tabel
            $medewerker = Medewerker::create([
                'PersoonId' => $persoon->Id,
                'Nummer' => $validated['nummer'],
                'Medewerkertype' => $validated['medewerkertype'],
                'Specialisatie' => $validated['specialisatie'],
                'Beschikbaarheid' => $validated['beschikbaarheid'],
                'ContractVerloopdatum' => $validated['contractverloopdatum'],
            ]);

            return redirect()->route('praktijkmanager.medewerkers')->with('success', 'Medewerker succesvol aangemaakt.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het aanmaken van de medewerker: ' . $e->getMessage());
        }
    }

    //     public function destroy($id)
    //     {
    //         try {
    //             $medewerker = Medewerker::findOrFail($id);

    //             if (!$medewerker) {
    //                 Log::warning('Medewerker niet gevonden.', ['id' => $id]);
    //                 return redirect()->back()->with('error', 'Medewerker niet gevonden.');
    //             }

    //             DB::statement('CALL spDeleteMedewerker(?)', [$id]);
    //             Log::info('Medewerker succesvol verwijderd.', ['id' => $id]);

    //             return redirect()->route('praktijkmanager.medewerkers')->with('success', 'Medewerker succesvol verwijderd.');
    //         } catch (\Exception $e) {
    //             Log::error('Fout bij het verwijderen van medewerker:', [
    //                 'id' => $id,
    //                 'error' => $e->getMessage(),
    //                 'trace' => $e->getTraceAsString()
    //             ]);
    //             return redirect()->back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de medewerker.');
    //         }
    //     }

    public function destroy($id)
    {
        try {
            $medewerker = Medewerker::findOrFail($id);

            if (!$medewerker) {
                Log::warning('Medewerker niet gevonden.', ['id' => $id]);
                return redirect()->back()->with('error', 'Medewerker niet gevonden.');
            }

            if ($medewerker->ContractVerloopdatum >= now()) {
                return redirect()->back()->with('error', 'Medewerker kan niet worden verwijderd. Het contract is nog niet verlopen.');
            }

            $persoonId = $medewerker->PersoonId;

            $medewerker->delete();

            if ($persoonId) {
                $persoon = Persoon::findOrFail($persoonId);
                if ($persoon)
                    $persoon->delete();
            }

            Log::info('Medewerker succesvol verwijderd.', ['id' => $id]);

            return redirect()->route('praktijkmanager.medewerkers')->with('success', 'Medewerker succesvol verwijderd.');
        } catch (\Exception $e) {
            Log::error('Fout bij het verwijderen van medewerker:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de medewerker.');
        }
    }
}
