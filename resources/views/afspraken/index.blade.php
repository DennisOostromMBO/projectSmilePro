<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afsprakenoverzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afsprakenoverzicht</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($afspraken->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                Er zijn geen afspraken beschikbaar. <a href="{{ route('afspraken.create') }}" class="text-blue-500 underline">Maak een nieuwe afspraak</a>.
            </div>
        @else
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">Datum</th>
                        <th class="px-4 py-2">Tijd</th>
                        <th class="px-4 py-2">Notities</th>
                        <th class="px-4 py-2">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($afspraken as $afspraak)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $afspraak->datum }}</td>
                            <td class="px-4 py-2">{{ $afspraak->tijd }}</td>
                            <td class="px-4 py-2">{{ $afspraak->notities ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('afspraken.edit', $afspraak->id) }}" class="text-blue-500 underline">Bewerken</a>
                                <form action="{{ route('afspraken.destroy', $afspraak->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 underline ml-2" onclick="return confirm('Weet je zeker dat je deze afspraak wilt verwijderen?')">Verwijderen</button>
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
