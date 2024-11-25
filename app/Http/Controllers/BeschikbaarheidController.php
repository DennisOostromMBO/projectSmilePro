<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beschikbaarheid;

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        return view('beschikbaarheid.index');
    }

    public function getBeschikbaarheden(Request $request)
    {
        $date = $request->input('date');
        $beschikbaarheden = Beschikbaarheid::whereDate('DatumVanaf', $date)->get();
        
        return response()->json($beschikbaarheden);
    }
}