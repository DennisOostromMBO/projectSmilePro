<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class EmailController extends Controller
{
    public function index()
    {
        try {
            // Haal alle e-mails op, inclusief de benodigde velden voor de frontend
            $emails = Email::all();
            return response()->json($emails);
        } catch (Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het ophalen van de e-mails.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Valideer de inkomende gegevens
            $validated = $request->validate([
                'to' => 'required|email',
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            // Maak een nieuwe e-mail aan
            $email = Email::create([
                'to' => $validated['to'],
                'subject' => $validated['subject'],
                'body' => $validated['body'],
            ]);

            return response()->json(['success' => true, 'email' => $email]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het opslaan van de e-mail.'], 500);
        }
    }

    public function show($id)
    {
        try {
            // Haal een specifieke e-mail op
            $email = Email::findOrFail($id);
            return response()->json($email);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'E-mail niet gevonden.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het ophalen van de e-mail.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Zoek de e-mail op basis van ID en werk deze bij
            $email = Email::findOrFail($id);

            // Valideer de inkomende gegevens voor bijwerken
            $validated = $request->validate([
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            $email->update([
                'subject' => $validated['subject'],
                'body' => $validated['body'],
            ]);

            return response()->json(['success' => true, 'email' => $email]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'E-mail niet gevonden.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het bijwerken van de e-mail.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Zoek de e-mail op basis van ID
            $email = Email::findOrFail($id);

            // Verwijder de e-mail
            $email->delete();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'E-mail niet gevonden.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het verwijderen van de e-mail.'], 500);
        }
    }
}
