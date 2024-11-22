<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['persoon', 'contact'])->get();

        return view('patient.index', compact('patients'));
    }
}

