<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraak Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afspraak Bewerken</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('afspraken.update', $afspraak->id) }}" method="POST" class="bg-white shadow-md rounded p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="volledige_naam" class="block text-gray-700">Volledige Naam</label>
                <input type="text" id="volledige_naam" name="volledige_naam" value="{{ $afspraak->volledige_naam }}" class="w-full p-2 border rounded" disabled>
            </div>

            <div class="mb-4">
                <label for="leeftijdsgroep" class="block text-gray-700">Leeftijdsgroep</label>
                <input type="text" id="leeftijdsgroep" name="leeftijdsgroep" value="{{ $afspraak->leeftijdsgroep }}" class="w-full p-2 border rounded" disabled>
            </div>

            <div class="mb-4">
                <label for="datum" class="block text-gray-700">Datum</label>
                <input type="date" id="datum" name="datum" value="{{ $afspraak->datum }}" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="tijd" class="block text-gray-700">Tijd</label>
                <input type="time" id="tijd" name="tijd" value="{{ $afspraak->tijd }}" class="w-full p-2 border rounded" required>
                @if ($errors->has('tijd'))
                @endif
            </div>

            <div class="mb-4">
                <label for="berichten" class="block text-gray-700">Berichten</label>
                <textarea id="berichten" name="berichten" class="w-full p-2 border rounded">{{ $afspraak->berichten }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
        </form>
    </div>
</body>
</html>
