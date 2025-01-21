<!DOCTYPE html>
<html>
<head>
    <title>Factuur Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Factuur Overzicht</h1>
        <a href="{{ route('factuur.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Factuur Aanmaken</a>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Persoon ID</th>
                    <th class="py-2 px-4 border-b">Naam Persoon</th>
                    <th class="py-2 px-4 border-b">Beschrijving</th>
                    <th class="py-2 px-4 border-b">Vervaldatum</th>
                    <th class="py-2 px-4 border-b">BTW</th>
                    <th class="py-2 px-4 border-b">Totaal Bedrag</th>
                    <th class="py-2 px-4 border-b">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturen as $factuur)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $factuur->persoonId }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $factuur->persoon ? $factuur->persoon->fname : 'N/A' }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $factuur->beschrijving }}</td>
                        <td class="py-2 px-4 border-b">{{ $factuur->vervaldatum }}</td>
                        <td class="py-2 px-4 border-b">{{ $factuur->btw }}</td>
                        <td class="py-2 px-4 border-b">{{ $factuur->totaal_bedrag }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('factuur.edit', $factuur->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Bewerken</a>
                            <form action="{{ route('factuur.destroy', $factuur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je de factuur wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
