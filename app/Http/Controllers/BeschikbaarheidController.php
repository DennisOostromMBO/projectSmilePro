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

    public function deleteBeschikbaarheid(Request $request)
    {
        try {
            $validatedData = $request->validate([
            'MedewerkerId' => 'required|integer',
            'DatumVanaf' => 'required|date',
            ]);

            $beschikbaarheid = Beschikbaarheid::where('MedewerkerId', $validatedData['MedewerkerId'])
            ->where('DatumVanaf', $validatedData['DatumVanaf'])
            ->first(); // Find the beschikbaarheid

            if (!$beschikbaarheid) {
            return response()->json([
                'error' => 'Beschikbaarheid niet gevonden'
            ], 404);
            }

            if (strtotime($beschikbaarheid->DatumVanaf) < strtotime(date('Y-m-d'))) {
            return response()->json([
                'error' => 'Beschikbaarheid in het verleden kan niet worden verwijderd'
            ], 400);
            } // Check if the beschikbaarheid is in the past

            if ($beschikbaarheid->delete()) {
            \Log::info('Beschikbaarheid verwijderd', ['MedewerkerId' => $validatedData['MedewerkerId'], 'DatumVanaf' => $validatedData['DatumVanaf']]);
            return response()->json([
                'success' => true,
                'message' => 'Beschikbaarheid succesvol verwijderd'
            ]);
            } else {
            return response()->json([
                'error' => 'Failed to delete beschikbaarheid'
            ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
            'error' => 'Failed to delete beschikbaarheid',
            'message' => $e->getMessage()
            ], 500);
        }
    }

    // public function deleteBeschikbaarheid(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'Id' => 'required|integer',
    //         ]);

    //         $beschikbaarheid = Beschikbaarheid::find($validatedData['Id']); // Find the beschikbaarheid by Id

    //         if (!$beschikbaarheid) {
    //             return response()->json([
    //                 'error' => 'Beschikbaarheid niet gevonden'
    //             ], 404);
    //         }

    //         if (strtotime($beschikbaarheid->DatumVanaf) < strtotime(date('Y-m-d'))) {
    //             return response()->json([
    //                 'error' => 'Beschikbaarheid in het verleden kan niet worden verwijderd'
    //             ], 400);
    //         } // Check if the beschikbaarheid is in the past

    //         if ($beschikbaarheid->delete()) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Beschikbaarheid succesvol verwijderd'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'error' => 'Failed to delete beschikbaarheid'
    //             ], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to delete beschikbaarheid',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function makeBeschikbaarheid(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'MedewerkerId' => 'required|integer',
                'DatumVanaf' => 'required|date',
                'DatumTotMet' => 'required|date',
                'TijdVanaf' => 'required|date_format:H:i',
                'TijdTotMet' => 'required|date_format:H:i',
                'Status' => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
                'Opmerking' => 'nullable|string',
            ]);

            // kijkt als datum vanaf en datum tot met niet op zaterdag of zondag valt
            $datumVanaf = strtotime($validatedData['DatumVanaf']);
            $datumTotMet = strtotime($validatedData['DatumTotMet']);
            if (date('N', $datumVanaf) >= 6 || date('N', $datumTotMet) >= 6) {
                return response()->json([
                    'error' => 'Beschikbaarheid kan niet op zaterdag of zondag worden ingesteld.'
                ], 400);
            }
    
            // Create a new beschikbaarheid
            $beschikbaarheid = Beschikbaarheid::create([
                'MedewerkerId' => $validatedData['MedewerkerId'],
                'DatumVanaf' => $validatedData['DatumVanaf'],
                'DatumTotMet' => $validatedData['DatumTotMet'],
                'TijdVanaf' => $validatedData['TijdVanaf'],
                'TijdTotMet' => $validatedData['TijdTotMet'],
                'Status' => $validatedData['Status'],
                'Opmerking' => $validatedData['Opmerking'] ?? '',
                'IsActief' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Beschikbaarheid succesvol aangemaakt.',
                'data' => $beschikbaarheid
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Interne serverfout',
                'message' => $e->getMessage()
            ], 500);
        }
    }

   
    public function store(Request $request)
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

            $beschikbaarheid = Beschikbaarheid::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Beschikbaarheid succesvol opgeslagen.',
                'data' => $beschikbaarheid
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store beschikbaarheid', 'message' => $e->getMessage()], 500);
        }
    }
}