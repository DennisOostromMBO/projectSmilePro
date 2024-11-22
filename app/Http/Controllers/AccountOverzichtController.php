<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GebruikerModel;

class AccountOverzichtController extends Controller
{
    public function index()
    {
        $gebruikers = GebruikerModel::all();
        return view('AccountOverzicht.accountOverzicht', compact('gebruikers'));
    }
}