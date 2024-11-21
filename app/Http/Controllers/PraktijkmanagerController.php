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
        $medewerkers = Medewerker::with('persoon')->get();
        // $medewerkers = [];

        return view(
            "praktijkmanager.medewerkers",
            compact("medewerkers")
        );
    }
}