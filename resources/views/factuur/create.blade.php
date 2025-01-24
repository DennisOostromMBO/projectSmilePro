<!DOCTYPE html>
<html>
<head>
    <title>Factuur Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function calculateBTW() {
            const totaalBedrag = parseFloat(document.getElementById('totaal_bedrag').value) || 0;
            const btw = totaalBedrag * 0.21;
            document.getElementById('btw').value = btw.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#persoon_id').select2({
                placeholder: 'Selecteer een persoon',
                allowClear: true
            });
        });
    </script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Factuur Aanmaken</h1>

        @if(session('message'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('factuur.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
            @csrf
            <div class="mb-4">
                <label for="persoon_id" class="block text-gray-700">Persoon</label>
                <select name="persoon_id" id="persoon_id" class="w-full border-gray-300 rounded mt-1" required>
                    @foreach($personen as $persoon)
                        <option value="{{ $persoon->Id }}">
                            {{ $persoon->VolledigeNaam }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700">Beschrijving</label>
                <input type="text" name="beschrijving" id="beschrijving" class="w-full border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-gray-700">Vervaldatum</label>
                <input type="date" name="vervaldatum" id="vervaldatum" class="w-full border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="totaal_bedrag" class="block text-gray-700">Totaal Bedrag</label>
                <input type="number" step="0.01" name="totaal_bedrag" id="totaal_bedrag" class="w-full border-gray-300 rounded mt-1" oninput="calculateBTW()" required>
            </div>
            <div class="mb-4">
                <label for="btw" class="block text-gray-700">BTW</label>
                <input type="number" step="0.01" name="btw" id="btw" class="w-full border-gray-300 rounded mt-1" readonly>
            </div>
            <div class="flex justify-between items-center">
                <a href="{{ route('factuur.index') }}" class="bg-gray-100 text-blue-500 px-4 py-2 rounded border border-gray-300 hover:bg-gray-200">
                    Terug naar Factuur
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
