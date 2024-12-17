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
        return response()->json(['success' => true, 'email' => $email]);
    }

    public function show($id)
    {
        // Haal een specifieke e-mail op
        $email = Email::findOrFail($id);
        return response()->json($email);
    }

    public function update(Request $request, $id)
    {
        // Zoek de e-mail op basis van ID en werk deze bij
        $email = Email::findOrFail($id);
        $email->update($request->only(['subject', 'body']));
        return response()->json(['success' => true, 'email' => $email]);
    }
}
