<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beschikbaarheid;

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        $beschikbaarheden = Beschikbaarheid::all();
        return view('beschikbaarheid.index', ['beschikbaarheden' => $beschikbaarheden]);
    }

    public function getBeschikbaarheden(Request $request)
    {
        $date = $request->input('date');
        $beschikbaarheden = Beschikbaarheid::whereDate('DatumVanaf', $date)->get();
        
        return response()->json($beschikbaarheden);
    }
}