<?php
// app/Http/Controllers/FactuurController.php
namespace App\Http\Controllers;

use App\Models\Factuur;
use App\Models\Persoon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FactuurController extends Controller
{
    public function index()
    {
        $facturen = Factuur::with('persoon')->get();
        return view('factuur.index', compact('facturen'));
    }

    public function create()
    {
        // Fetch all records from the personen table and handle NULL values for Tussenvoegsel
        $personen = DB::table('personen')
            ->select('Id', DB::raw("CONCAT(Voornaam, ' ', COALESCE(Tussenvoegsel, ''), ' ', Achternaam) as fname"))
            ->distinct()
            ->get();

        return view('factuur.create', compact('personen'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'persoonId' => 'required|exists:personen,Id',
            'beschrijving' => 'required',
            'vervaldatum' => 'required|date',
            'btw' => 'required|numeric',
            'totaal_bedrag' => 'required|numeric',
        ]);

        try {
            Log::info('Creating Factuur', $request->all());

            Factuur::create($request->all());

            return redirect()->route('factuur.index')->with('success', 'Factuur created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating Factuur', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'There was an error creating the Factuur: ' . $e->getMessage());
        }
    }

/*
    public function store(Request $request)
    {
        $request->validate([
            'persoonId' => 'required|exists:persoon,Id',
            'beschrijving' => 'required',
            'vervaldatum' => 'required|date',
            'btw' => 'required|numeric',
            'totaal_bedrag' => 'required|numeric',
        ]);

        Log::info('Creating Factuur', $request->all());

        Factuur::create($request->all());

        return redirect()->route('factuur.index')->with('success', 'Factuur created successfully.');
    }
*/
public function edit($id)
{
    $factuur = Factuur::findOrFail($id);
    $personen = DB::table('personen')
            ->select('Id', DB::raw("CONCAT(Voornaam, ' ', COALESCE(Tussenvoegsel, ''), ' ', Achternaam) as fname"))
        ->distinct()
        ->get();

    return view('factuur.edit', compact('factuur', 'personen'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'persoonId' => 'required|exists:personen,Id',
        'beschrijving' => 'required',
        'vervaldatum' => 'required|date',
        'btw' => 'required|numeric',
        'totaal_bedrag' => 'required|numeric',
    ]);

    try {
        Log::info('Updating Factuur', $request->all());

        $factuur = Factuur::findOrFail($id);
        $factuur->update($request->all());

        return redirect()->route('factuur.index')->with('success', 'Factuur updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error updating Factuur', ['error' => $e->getMessage()]);

        return redirect()->back()->with('error', 'There was an error updating the Factuur: ' . $e->getMessage());
    }
}

    public function destroy($id)
    {
        Log::info('Deleting Factuur', ['id' => $id]);

        $factuur = Factuur::findOrFail($id);
        $factuur->delete();

        return redirect()->route('factuur.index')->with('success', 'Factuur deleted successfully.');
    }
}
