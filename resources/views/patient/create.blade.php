<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voeg Patiënt Toe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-lg shadow-lg w-full max-w-6xl">
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <h1 class="text-2xl font-bold mb-6">Voeg Patiënt Toe</h1>

        <form action="{{ route('patient.store') }}" method="POST">
            @csrf

            <!-- Persoon gegevens -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="voornaam" class="block text-sm font-semibold">Voornaam</label>
                    <input type="text" name="Voornaam" id="voornaam" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="tussenvoegsel" class="block text-sm font-semibold">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="achternaam" class="block text-sm font-semibold">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="geboortedatum" class="block text-sm font-semibold">Geboortedatum</label>
                    <input type="date" name="geboortedatum" id="geboortedatum" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
            </div>

            <!-- Contact gegevens -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="telefoonnummer" class="block text-sm font-semibold">Telefoonnummer</label>
                    <input type="text" name="telefoonnummer" id="telefoonnummer" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="postcode" class="block text-sm font-semibold">Postcode</label>
                    <input type="text" name="postcode" id="postcode" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="huisnummer" class="block text-sm font-semibold">Huisnummer</label>
                    <input type="text" name="huisnummer" id="huisnummer" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="plaats" class="block text-sm font-semibold">Plaats</label>
                    <input type="text" name="plaats" id="plaats" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="toevoeging" class="block text-sm font-semibold">Toevoeging (Huisnummer)</label>
                    <input type="text" name="toevoeging" id="toevoeging" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="straatnaam" class="block text-sm font-semibold">Straatnaam</label>
                    <input type="text" name="straatnaam" id="straatnaam" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
            </div>

            <!-- Medisch Dossier -->
            <div class="mb-6">
                <label for="medisch_dossier" class="block text-sm font-semibold">Medisch Dossier</label>
                <textarea name="medisch_dossier" id="medisch_dossier" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
            </div>

            <!-- Submit knop -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
