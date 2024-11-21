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
        // $medewerkers = DB::table('medewerkers')->get();

        // $patients = Patient::with('persoon')->get();

        $medewerkers = Medewerker::with('persoon')->get();
        // $medewerkers = [];

        // dd($medewerkers);

        return view(
            "praktijkmanager.medewerkers",
            compact("medewerkers")
        );
    }
}