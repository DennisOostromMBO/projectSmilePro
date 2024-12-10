<!-- resources/views/factuur/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Factuur</title>
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
        <h1 class="text-2xl font-bold mb-4">Create Factuur</h1>
        <form action="{{ route('factuur.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="klant_id" class="block text-gray-700">Klant ID</label>
                <input type="text" name="klant_id" id="klant_id" class="w-full border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700">Beschrijving</label>
                <textarea name="beschrijving" id="beschrijving" class="w-full border-gray-300 rounded mt-1" required></textarea>
            </div>
            <div class="mb-4">
                <label for="vervaldatum" class="block text-gray-700">Vervaldatum</label>
                <input type="date" name="vervaldatum" id="vervaldatum" class="w-full border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="totaal_bedrag" class="block text-gray-700">Totaal Bedrag</label>
                <input type="number" name="totaal_bedrag" id="totaal_bedrag" class="w-full border-gray-300 rounded mt-1" required oninput="calculateBTW()">
            </div>
            <div class="mb-4">
                <label for="btw" class="block text-gray-700">BTW</label>
                <input type="number" name="btw" id="btw" class="w-full border-gray-300 rounded mt-1" readonly>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>
</body>
</html>
