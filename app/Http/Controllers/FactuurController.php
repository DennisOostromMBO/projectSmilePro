<?php
namespace App\Http\Controllers;

use App\Models\Factuur;
use Illuminate\Http\Request;

class FactuurController extends Controller
{
    public function index()
    {
        $factuur = Factuur::all();
        return view('factuur.index', compact('factuur'));
    }

    public function create()
    {
        return view('factuur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
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
        $factuur = Factuur::findOrFail($id);
        return view('factuur.edit', compact('factuur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
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
