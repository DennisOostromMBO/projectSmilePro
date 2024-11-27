<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht Patiënten</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @if ($patients->isEmpty())
        <meta http-equiv="refresh" content="4; url={{ url('/') }}">
    @endif
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-lg shadow-lg w-full max-w-6xl">
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>

        <h1 class="text-2xl font-bold mb-6">Overzicht Patiënten</h1>

        @if (count($patients) <= 0 || $patients == null || $patients->isEmpty())
            <h3 class="text-red-500">Momenteel geen patiënt gegevens beschikbaar</h3>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Id</th>
                        <th class="py-2 px-4 border-b">Volledige naam</th>
                        <th class="py-2 px-4 border-b">Geboortedatum</th>
                        <th class="py-2 px-4 border-b">Volledig adres</th>
                        <th class="py-2 px-4 border-b">Mobielnummer</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Nummer</th>
                        <th class="py-2 px-4 border-b">Medisch Dossier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $patient->Id }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->persoon->VolledigeNaam }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->persoon->Geboortedatum }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->contact->VolledigAdres }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->contact->Mobiel }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->contact->Email }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->Nummer }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->MedischDossier }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
