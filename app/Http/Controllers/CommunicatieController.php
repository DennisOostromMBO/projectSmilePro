<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunicatieController extends Controller
{
    public function index()
    {
        return view('communicatie.index');
    }
}
