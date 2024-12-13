<?php
// app/Http/Controllers/FactuurController.php
namespace App\Http\Controllers;

use App\Models\Factuur;
use App\Models\Persoon;
use Illuminate\Http\Request;

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
            'klant_id' => 'required',
            'beschrijving' => 'required',
            'vervaldatum' => 'required|date',
            'btw' => 'required|numeric',
            'totaal_bedrag' => 'required|numeric',
        ]);

        Factuur::create($request->all());

        return redirect()->route('factuur.index')->with('success', 'Factuur created successfully.');
    }

    public function edit($id)
    {
        $factuur = Factuur::with('persoon')->findOrFail($id);
        $personen = Persoon::all();
        return view('factuur.edit', compact('factuur', 'personen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persoon_id' => 'required|exists:persoon,id',
            'klant_id' => 'required',
            'beschrijving' => 'required',
            'vervaldatum' => 'required|date',
            'btw' => 'required|numeric',
            'totaal_bedrag' => 'required|numeric',
        ]);

        $factuur = Factuur::findOrFail($id);
        $factuur->update($request->all());

        return redirect()->route('factuur.index')->with('success', 'Factuur updated successfully.');
    }
}
