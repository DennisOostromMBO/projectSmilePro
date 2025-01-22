<!-- filepath: /c:/Users/Wassim/Desktop/project2024/projectSmilePro/resources/views/factuur/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Factuur Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function calculateBTW() {
            const totaalBedrag = parseFloat(document.getElementById('totaal_bedrag').value) || 0;
            const btw = (totaalBedrag * 21) / 121;
            document.getElementById('btw').value = btw.toFixed(2);
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Factuur Bewerken</h1>
        <form action="{{ route('factuur.update', $factuur->id) }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="persoonId" class="block text-gray-700">Persoon</label>
                <select name="persoonId" id="persoonId" class="w-full border-gray-300 rounded mt-1" required>
                    @foreach($personen as $persoon)
                        <option value="{{ $persoon->Id }}" {{ $factuur->persoonId == $persoon->Id ? 'selected' : '' }}>
                            {{ $persoon->fname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700">Beschrijving</label>
                <textarea name="beschrijving" id="beschrijving" class="w-full border-gray-300 rounded mt-1" required>{{ $factuur->beschrijving }}</textarea>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-gray-700">Vervaldatum</label>
                <input type="date" name="vervaldatum" id="vervaldatum" value="{{ $factuur->vervaldatum }}" class="w-full border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="totaal_bedrag" class="block text-gray-700">Totaal Bedrag</label>
                <input type="number" name="totaal_bedrag" id="totaal_bedrag" value="{{ $factuur->totaal_bedrag }}" class="w-full border-gray-300 rounded mt-1" required oninput="calculateBTW()">
            </div>
            <div class="mb-4">
                <label for="btw" class="block text-gray-700">BTW</label>
                <input type="number" name="btw" id="btw" value="{{ $factuur->btw }}" class="w-full border-gray-300 rounded mt-1" readonly>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Bijwerken</button>
        </form>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('factuur.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Terug naar Facturen</a>
    </div>  
</body>
</html>
