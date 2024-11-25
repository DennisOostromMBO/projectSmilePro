<?php

namespace App\Http\Controllers;

abstract class Controller
{
    class BeschikbaarheidController extends Controller
    {
        public function index()
        {
            $patients = Patient::with('persoon')->get();
    
            return view('patient.index', compact('patients'));
        }
    }
    }
