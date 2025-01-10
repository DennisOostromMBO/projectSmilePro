<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voeg Patiënt Toe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .input-container {
            position: relative;
            margin-bottom: 1rem;
        }

        .error-message {
            position: absolute;
            top: -1.5rem;
            left: 0;
            color: #e53e3e;
            font-size: 0.875rem;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-lg shadow-lg w-full max-w-6xl">
        <h1 class="text-2xl font-bold mb-6">Voeg Patiënt Toe</h1>


        <form action="{{ route('patient.store') }}" method="POST">
            @csrf

            @if ($errors->has('email_exists'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Let op!</strong> {{ $errors->first('email_exists') }}
                </div>
            @endif

            @if ($errors->has('mobiel_exists'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Let op!</strong> {{ $errors->first('mobiel_exists') }}
                </div>
            @endif


            <!-- Persoon gegevens -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="input-container">
                    @error('voornaam')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Voornaam" class="block text-sm font-semibold">Voornaam</label>
                    <input type="text" name="voornaam" id="Voornaam" value="{{ old('voornaam') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('voornaam') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('tussenvoegsel')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Tussenvoegsel" class="block text-sm font-semibold">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="Tussenvoegsel" value="{{ old('tussenvoegsel') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('tussenvoegsel') border-red-500 @enderror">
                </div>
                <div class="input-container">
                    @error('achternaam')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Achternaam" class="block text-sm font-semibold">Achternaam</label>
                    <input type="text" name="achternaam" id="Achternaam" value="{{ old('achternaam') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('achternaam') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('geboortedatum')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Geboortedatum" class="block text-sm font-semibold">Geboortedatum</label>
                    <input type="date" name="geboortedatum" id="Geboortedatum" value="{{ old('geboortedatum') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('geboortedatum') border-red-500 @enderror"
                        required>
                </div>
            </div>

            <!-- Contact Gegevens -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="input-container">
                    <!-- Specifieke foutmelding voor mobiel -->
                    @error('mobiel')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Mobiel" class="block text-sm font-semibold">Mobiel</label>
                    <input type="text" name="mobiel" id="Mobiel" value="{{ old('mobiel') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('mobiel') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Email" class="block text-sm font-semibold">Email</label>
                    <input type="email" name="email" id="Email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('email') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('postcode')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Postcode" class="block text-sm font-semibold">Postcode</label>
                    <input type="text" name="postcode" id="Postcode" value="{{ old('postcode') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('postcode') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('plaats')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Plaats" class="block text-sm font-semibold">Plaats</label>
                    <input type="text" name="plaats" id="Plaats" value="{{ old('plaats') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('plaats') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('huisnummer')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Huisnummer" class="block text-sm font-semibold">Huisnummer</label>
                    <input type="text" name="huisnummer" id="Huisnummer" value="{{ old('huisnummer') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('huisnummer') border-red-500 @enderror"
                        required>
                </div>
                <div class="input-container">
                    @error('toevoeging')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Toevoeging" class="block text-sm font-semibold">Toevoeging (Huisnummer)</label>
                    <input type="text" name="toevoeging" id="Toevoeging" value="{{ old('toevoeging') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('toevoeging') border-red-500 @enderror">
                </div>
                <div class="input-container">
                    @error('straatnaam')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <label for="Straatnaam" class="block text-sm font-semibold">Straatnaam</label>
                    <input type="text" name="straatnaam" id="Straatnaam" value="{{ old('straatnaam') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        @error('straatnaam') border-red-500 @enderror"
                        required>
                </div>
            </div>

            <!-- Medisch Dossier -->
            <div class="input-container mb-6">
                @error('medisch_dossier')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <label for="MedischDossier" class="block text-sm font-semibold">Medisch Dossier</label>
                <textarea name="medisch_dossier" id="MedischDossier" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                    @error('medisch_dossier') border-red-500 @enderror"
                    required>{{ old('medisch_dossier') }}</textarea>
            </div>

            <!-- Submit knop -->
            <div class="flex justify-end items-center space-x-4">
                <a href="{{ route('patient.index') }}"
                    class="bg-gray-100 text-blue-500 px-6 py-2 rounded-lg hover:bg-gray-200 border border-gray-300">
                    Terug naar overzicht
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</body>

</html>
