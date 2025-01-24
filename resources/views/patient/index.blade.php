<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht Patiënten</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @if ($patients->isEmpty())<meta http-equiv="refresh" content="4; url={{ url('/') }}">@endif
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-12 rounded-lg shadow-lg w-full max-w-7xl">
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Overzicht Patiënten</h1>

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

        <!-- Add Patient Button -->
        <div class="flex flex-col sm:flex-row sm:justify-between mb-6">
            <a href="{{ route('patient.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 flex items-center justify-center">
                <i class="bi bi-person-plus mr-2"></i> Voeg Patiënt Toe
            </a>
        </div>

        <!-- Patient List -->
        @if ($patients->isEmpty())
            <h3 class="text-red-500 text-center">Momenteel geen patiëntgegevens beschikbaar</h3>
        @else
            <div class="hidden md:block overflow-x-auto">
                <!-- Standaard tabel voor grotere schermen -->
                <table class="min-w-full bg-white border border-gray-200 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 border-b text-left font-semibold">Naam</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Leeftijdscategorie</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Adres</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Mobielnummer</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Email</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Nummer</th>
                            <th class="py-3 px-4 border-b text-left font-semibold">Medisch Dossier</th>
                            <th class="py-3 px-4 border-b text-center font-semibold">Bijwerken</th>
                            <th class="py-3 px-4 border-b text-center font-semibold">Verwijderen</th>
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
                                    <a href="{{ route('patient.edit', ['id' => $patient->PatiëntId]) }}" class="text-yellow-500 hover:text-yellow-600">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                                <td class="py-3 px-4 border-b text-center">
                                    <form action="{{ route('patient.destroy', ['id' => $patient->PatiëntId]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Weet je zeker dat je deze patiënt wilt verwijderen?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Kaartenweergave voor kleine schermen -->
            <div class="block md:hidden grid gap-4">
                @foreach ($patients as $patient)
                    <div class="bg-gray-50 p-4 rounded-lg shadow-md border border-gray-200">
                        <div class="mb-2">
                            <span class="font-semibold">Naam:</span>
                            <span>{{ $patient->VolledigeNaam }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Leeftijdscategorie:</span>
                            <span>{{ $patient->LeeftijdCategorie }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Adres:</span>
                            <span>{{ $patient->VolledigAdres }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Mobielnummer:</span>
                            <span>{{ $patient->Mobielnummer }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Email:</span>
                            <span>{{ $patient->Email }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Nummer:</span>
                            <span>{{ $patient->Nummer }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-semibold">Medisch Dossier:</span>
                            <span>{{ $patient->MedischDossier }}</span>
                        </div>
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('patient.edit', ['id' => $patient->PatiëntId]) }}" class="text-yellow-500 hover:text-yellow-600">
                                <i class="bi bi-pencil"></i> Bewerken
                            </a>
                            <form action="{{ route('patient.destroy', ['id' => $patient->PatiëntId]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600" onclick="return confirm('Weet je zeker dat je deze patiënt wilt verwijderen?')">
                                    <i class="bi bi-trash"></i> Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $patients->links() }}
            </div>
        @endif
    </div>
</body>
</html>