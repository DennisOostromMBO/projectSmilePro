<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beschikbaarheid;
use App\Models\BeschikbaarheidView;
use Illuminate\Support\Facades\DB; // Import the DB facade

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        try {
            $beschikbaarheden = BeschikbaarheidView::all();
            return view('beschikbaarheid.index', ['beschikbaarheden' => $beschikbaarheden]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve beschikbaarheden', 'message' => $e->getMessage()], 500);
        }
    }

    public function getBeschikbaarhedenByMonth(Request $request)
    {
        try {
            $month = $request->input('month'); 
            $year = $request->input('year'); 
            $beschikbaarheden = BeschikbaarheidView::whereYear('DatumVanaf', $year)
                                                   ->whereMonth('DatumVanaf', $month)
                                                   ->get(); 
            return response()->json($beschikbaarheden);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve beschikbaarheden', 'message' => $e->getMessage()], 500); 
        }
    }

    public function saveBeschikbaarheid(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'MedewerkerId' => 'required|integer|exists:medewerkers,Id',
                'DatumVanaf' => 'required|date',
                'DatumTotMet' => 'required|date',
                'TijdVanaf' => 'required|date_format:H:i',
                'TijdTotMet' => 'required|date_format:H:i',
                'Status' => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
                'Opmerking' => 'nullable|string',
            ]);

            $beschikbaarheid = new Beschikbaarheid();
            $beschikbaarheid->MedewerkerId = $validatedData['MedewerkerId'];
            $beschikbaarheid->DatumVanaf = $validatedData['DatumVanaf'];
            $beschikbaarheid->DatumTotMet = $validatedData['DatumTotMet'];
            $beschikbaarheid->TijdVanaf = $validatedData['TijdVanaf'];
            $beschikbaarheid->TijdTotMet = $validatedData['TijdTotMet'];
            $beschikbaarheid->Status = $validatedData['Status'];
            $beschikbaarheid->Opmerking = $validatedData['Opmerking'] ?? '';
            $beschikbaarheid->IsActief = true;
            $beschikbaarheid->save();


            // \Log::info('Validated data:', $validatedData);
            // // Use a transaction for safer updates
            // $beschikbaarheid = DB::transaction(function () use ($validatedData) { 
            //     return Beschikbaarheid::updateOrCreate(
            //         [
            //             'MedewerkerId' => $validatedData['MedewerkerId'],
            //             'DatumVanaf' => $validatedData['DatumVanaf'],
            //         ],
            //         [
            //             'DatumTotMet' => $validatedData['DatumTotMet'],
            //             'TijdVanaf' => $validatedData['TijdVanaf'],
            //             'TijdTotMet' => $validatedData['TijdTotMet'],
            //             'Status' => $validatedData['Status'],
            //             'IsActief' => true,
            //             'Opmerking' => $validatedData['Opmerking'] ?? '',
            //         ]
            //     );
            // });

            return response()->json([
                'success' => true,
                'message' => 'Beschikbaarheid succesvol opgeslagen.',
                'data' => $beschikbaarheid
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Interne serverfout',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}