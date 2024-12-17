<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        // Haal alle e-mails op
        $emails = Email::all();
        return response()->json($emails);
    }

    public function store(Request $request)
    {
        // Maak een nieuwe e-mail aan
        $email = Email::create($request->only(['subject', 'body']));
        return response()->json($email);
    }

    
}
