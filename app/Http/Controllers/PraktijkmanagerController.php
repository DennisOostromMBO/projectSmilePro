<?php

namespace App\Http\Controllers;

use App\Models\Medewerker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PraktijkmanagerController extends Controller
{
    //

    public function index()
    {
        return view("praktijkmanager.index");
    }

    public function medewerkers()
{
    // Haal alle medewerkers op, inclusief gekoppelde persoon-data
    $medewerkers = Medewerker::with('persoon')->get();

    return view(
        "praktijkmanager.medewerkers",
        [
            "medewerkers" => $medewerkers
        ]
    );
}
}
