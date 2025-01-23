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
            $validatedData = $request->validate([
                'MedewerkerId' => 'required|integer',
                'DatumVanaf' => 'required|date',
                'DatumTotMet' => 'required|date',
                'TijdVanaf' => 'required|date_format:H:i',
                'TijdTotMet' => 'required|date_format:H:i',
                'Status' => 'required|string',
                'Opmerking' => 'nullable|string'
            ]);



            // Update the beschikbaarheid
            // Beschikbaarheid::where('Id', $beschikbaarheid->Id)->update([
            //     'MedewerkerId' => $validatedData['MedewerkerId'],
            //     'DatumVanaf' => $validatedData['DatumVanaf'],
            //     'DatumTotMet' => $validatedData['DatumTotMet'],
            //     'TijdVanaf' => $validatedData['TijdVanaf'],
            //     'TijdTotMet' => $validatedData['TijdTotMet'],
            //     'Status' => $validatedData['Status'],
            //     'Opmerking' => $validatedData['Opmerking'] ?? '',
            //     'IsActief' => true
            // ]);

            $beschikbaarheid = Beschikbaarheid::find($request->input('MedewerkerId'));

            DB::table('beschikbaarheid')
                ->where('Id', $beschikbaarheid->Id)
                ->update([
                    'MedewerkerId' => $validatedData['MedewerkerId'],
                    'DatumVanaf' => $validatedData['DatumVanaf'],
                    'DatumTotMet' => $validatedData['DatumTotMet'],
                    'TijdVanaf' => $validatedData['TijdVanaf'],
                    'TijdTotMet' => $validatedData['TijdTotMet'],
                    'Status' => $validatedData['Status'],
                    'Opmerking' => $validatedData['Opmerking'] ?? '',
                    'IsActief' => true
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Beschikbaarheid succesvol bijgewerkt.',
                'data' => $validatedData
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update beschikbaarheid', 'message' => $e->getMessage()], 500);
        }
    }
}