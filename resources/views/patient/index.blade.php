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

        <!-- Success or Error messages -->
        @if(session('success'))
            <div class="alert alert-success p-4 mb-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger p-4 mb-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if (!$patients->isEmpty())
        <div class="flex justify-between mb-6">
            <a href="{{ route('patient.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="bi bi-person-plus mr-2"></i> Voeg Patiënt Toe
            </a>
        </div>
        @endif

        @if (count($patients) <= 0 || $patients == null || $patients->isEmpty())
            <h3 class="text-red-500">Momenteel geen patiënt gegevens beschikbaar</h3>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Volledige naam</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Leeftijdscategorie</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Volledig adres</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Mobielnummer</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Email</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Nummer</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Medisch Dossier</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Bijwerken</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $patient->VolledigeNaam }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->LeeftijdCategorie }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->VolledigAdres }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->Mobielnummer }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->Email }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->Nummer }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->MedischDossier }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <a href="{{ route('patient.edit', ['id' => $patient->id]) }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
