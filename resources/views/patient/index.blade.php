<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht Patiënten</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-16 rounded-lg shadow-lg w-full max-w-7xl">

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
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Email</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Mobiel</th>
                        <th class="py-3 px-4 border-b text-left font-semibold text-sm">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="py-3 px-4 border-b">
                                @if ($patient->persoon)
                                    {{ $patient->persoon->voornaam }} {{ $patient->persoon->tussenvoegsel }} {{ $patient->persoon->achternaam }}
                                @else
                                    Geen gegevens
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">{{ $patient->email }}</td>
                            <td class="py-3 px-4 border-b">{{ $patient->mobiel }}</td>
                            <td class="py-3 px-4 border-b">
                                <a href="{{ route('patient.edit', $patient->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Bewerken</a>
                                <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>