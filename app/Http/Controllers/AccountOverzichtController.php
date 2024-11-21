<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountOverzichtController extends Controller
{
    public function index()
    {
        return view('AccountOverzicht.accountoverzicht');
    }
}