<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afsprakenoverzicht</title>
    <!-- Link naar TailwindCSS voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afsprakenoverzicht</h1>

        <!-- Navigatie links naar andere pagina's -->
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <a href="{{ route('afspraken.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Nieuwe Afspraak Aanmaken
        </a>

        <!-- Successbericht weergeven -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bericht wanneer er geen afspraken zijn -->
        @if ($afspraken->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                Er zijn geen afspraken beschikbaar. <a href="{{ route('afspraken.create') }}" class="text-blue-500 underline">Maak een nieuwe afspraak</a>.
            </div>
        @else
            <!-- Tabel van afspraken -->
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">Patiënt Naam</th>
                        <th class="px-4 py-2">Medewerker Naam</th>
                        <th class="px-4 py-2">Datum</th>
                        <th class="px-4 py-2">Tijd</th>
                        <th class="px-4 py-2">Type Afspraak</th>
                        <th class="px-4 py-2">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($afspraken as $afspraak)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $afspraak->patient_naam }}</td>
                            <td class="px-4 py-2">{{ $afspraak->medewerker_naam }}</td>
                            <td class="px-4 py-2">{{ $afspraak->datum }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($afspraak->tijd)->format('H:i') }}</td>
                            <td class="px-4 py-2">{{ $afspraak->type_afspraak ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <!-- Link naar bewerken van afspraak -->
                                <a href="{{ route('afspraken.edit', $afspraak->id) }}" class="text-blue-500 underline">Bewerken</a>
                                <!-- Formulier om afspraak te verwijderen -->
                               
                                <form action="{{ route('afspraken.destroy', $afspraak->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 underline ml-2"
                                        onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?')">Verwijderen</button>
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
