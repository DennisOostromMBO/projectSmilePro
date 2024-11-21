<?php

namespace App\Http\Controllers;

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
        $medewerkers = DB::table('medewerkers')->get();
        // $medewerkers = [];

        return view(
            "praktijkmanager.medewerkers",
            [
                "medewerkers" => $medewerkers
            ]
        );
    }
}