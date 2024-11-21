<?php

namespace App\Http\Controllers;

use App\Models\Afsprakenbeheer;
use Illuminate\Http\Request;

class AfsprakenbeheerController extends Controller
{
    public function index()
    {
        $afspraken = Afsprakenbeheer::all();
        return view('afsprakenbeheer.index', compact('afspraken'));
    }

    public function create()
    {
        return view('afsprakenbeheer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'PatiëntId' => 'required|exists:patients,id',
            'MedewerkerId' => 'required|exists:employees,id',
            'Datum' => 'required|date',
            'Tijd' => 'required|date_format:H:i',
            'Status' => 'required|in:Bevestigd,Geannuleerd',
            'IsActive' => 'nullable|boolean',
            'Comments' => 'nullable|string',
        ]);

        Afsprakenbeheer::create($request->all());
        return redirect()->route('afsprakenbeheer.index');
    }

    public function show($id)
    {
        $afspraak = Afsprakenbeheer::findOrFail($id);
        return view('afsprakenbeheer.show', compact('afspraak'));
    }
}
