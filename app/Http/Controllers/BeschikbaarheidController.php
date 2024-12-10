<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beschikbaarheid;

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        try {
            $beschikbaarheden = Beschikbaarheid::all();
            return view('beschikbaarheid.index', ['beschikbaarheden' => $beschikbaarheden]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve beschikbaarheden', 'message' => $e->getMessage()], 500);
        }
    }

    public function getBeschikbaarheden(Request $request)
    {
        try {
            $date = $request->input('date');
            $beschikbaarheden = Beschikbaarheid::whereDate('DatumVanaf', $date)->get();
            return response()->json($beschikbaarheden);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve beschikbaarheden', 'message' => $e->getMessage()], 500);
        }
    }
}