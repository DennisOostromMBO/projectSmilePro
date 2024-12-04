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

        <form action="{{ route('afspraken.update', $afspraak->id) }}" method="POST" class="bg-white shadow-md rounded p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="datum" class="block text-gray-700">Datum</label>
                <input type="date" id="datum" name="datum" value="{{ $afspraak->datum }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="tijd" class="block text-gray-700">Tijd</label>
                <input type="time" id="tijd" name="tijd" value="{{ $afspraak->tijd }}" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="notities" class="block text-gray-700">Notities</label>
                <textarea id="notities" name="notities" class="w-full p-2 border rounded">{{ $afspraak->notities }}</textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
        </form>
    </div>
</body>
</html>
