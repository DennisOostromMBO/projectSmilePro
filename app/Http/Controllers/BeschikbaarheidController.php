<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeschikbaarheidController extends Controller
{
    public function index()
    {
        return view('beschikbaarheid.index');
        
    }
}
