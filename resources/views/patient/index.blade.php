<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht Patiënten</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
                        <th class="py-2 px-4 border-b text-left">Volledige naam</th>
                        <th class="py-2 px-4 border-b text-left">Volledig adres</th>
                        <th class="py-2 px-4 border-b text-left">Mobielnummer</th>
                        <th class="py-2 px-4 border-b text-left">Email</th>
                        <th class="py-2 px-4 border-b text-left">Nummer</th>
                        <th class="py-2 px-4 border-b text-left">Medisch Dossier</th>
                        <th class="py-2 px-4 border-b text-left">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $patient->VolledigeNaam }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->VolledigAdres }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->Mobielnummer }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->Email }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->Nummer }}</td>
                            <td class="py-2 px-4 border-b">{{ $patient->MedischDossier }}</td>
                            <td class="py-2 px-4 border-b"><i class="bi bi-pencil"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
