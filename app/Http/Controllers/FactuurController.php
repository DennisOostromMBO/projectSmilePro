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
        $personen = Persoon::all();
        return view('factuur.create', compact('personen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persoon_id' => 'required|exists:persoon,id',
            'beschrijving' => 'required',
            'vervaldatum' => 'required|date',
            'totaal_bedrag' => 'required|numeric',
        ]);

        try {
            $data = $request->all();
            $data['btw'] = $data['totaal_bedrag'] * 0.21; // Bereken de BTW als 21% van het totaalbedrag

            Log::info('Creating Factuur', $data);

            Factuur::create($data);

            return redirect()->route('factuur.index')->with('success', 'Factuur created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating Factuur', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'There was an error creating the Factuur: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $factuur = Factuur::findOrFail($id);
        $personen = Persoon::all();

        return view('factuur.edit', compact('factuur', 'personen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persoon_id' => 'required|exists:persoon,id',
            'beschrijving' => 'required|string|max:255',
            'vervaldatum' => 'required|date',
            'totaal_bedrag' => 'required|numeric',
        ]);

        try {
            $data = $request->all();
            $data['btw'] = $data['totaal_bedrag'] * 0.21; // Bereken de BTW als 21% van het totaalbedrag

            Log::info('Updating Factuur', $data);

            $factuur = Factuur::findOrFail($id);
            $factuur->update($data);

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
