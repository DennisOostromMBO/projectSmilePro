<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overzicht Medewerkers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 ">
    <div class="w-full p-20 bg-white rounded-lg shadow-lg">
        <div class="flex flex-col">
            <a href="{{ url('/') }}" class="inline-block mb-4 text-blue-500 hover:underline">Terug naar Home</a>
            <a href="{{ route('praktijkmanager.medewerkers') }}"
                class="inline-block mb-4 text-blue-500 hover:underline">Terug naar
                Medewerkers</a>
        </div>

        <h1 class="mb-6 text-2xl font-bold">Medewerker Toevoegen</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('medewerkers.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="voornaam" class="block mb-2">Naam</label>
                <input type="text" name="voornaam" id="voornaam"
                    class="w-full p-2 border border-gray-300 rounded-lg" required value="{{ old('voornaam') }}">
                @if ($errors->has('voornaam'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('voornaam') }}
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <label for="tussenvoegsel" class="block mb-2">Tussenvoegsel</label>
                <input type="text" name="tussenvoegsel" id="tussenvoegsel"
                    class="w-full p-2 border border-gray-300 rounded-lg" value="{{ old('tussenvoegsel') }}">
                @if ($errors->has('tussenvoegsel'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('tussenvoegsel') }}
                    </div>
                @endif
            </div>
            <div class="mb-4">
                <label for="achternaam" class="block mb-2">Achternaam</label>
                <input type="text" name="achternaam" id="achternaam"
                    class="w-full p-2 border border-gray-300 rounded-lg" required value="{{ old('achternaam') }}">
                @if ($errors->has('achternaam'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('achternaam') }}
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="geboortedatum" class="block mb-2">Geboortedatum</label>
                <input type="date" class="w-full p-2 border border-gray-300 rounded-lg" id="geboortedatum"
                    name="geboortedatum" required value="{{ old('geboortedatum') }}">
                @if ($errors->has('geboortedatum'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('geboortedatum') }}
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="nummer" class="block mb-2">Nummer</label>
                <input type="text" name="nummer" id="nummer" class="w-full p-2 border border-gray-300 rounded-lg"
                    required value="{{ old('nummer') }}">
                @if ($errors->has('nummer'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('nummer') }}
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="medewerkertype" class="block mb-2">Medewerkertype</label>
                <select name="medewerkertype" id="medewerkertype" class="w-full p-2 border border-gray-300 rounded-lg"
                    required value="{{ old('medewerkertype') }}">
                    <option value="Assistent">
                        Assistent</option>
                    <option value="Mondhygiënist">Mondhygiënist
                    </option>
                    <option value="Tandarts">
                        Tandarts</option>
                    <option value="Praktijkmanagement">
                        Praktijkmanagement</option>

                </select>
                @if ($errors->has('medewerkertype'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('medewerkertype') }}
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="specialisatie" class="block mb-2">Specialisatie</label>
                <input type="text" name="specialisatie" id="specialisatie"
                    class="w-full p-2 border border-gray-300 rounded-lg" required value="{{ old('specialisatie') }}">
                @if ($errors->has('specialisatie'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                        {{ $errors->first('specialisatie') }}
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="beschikbaarheid" class="block mb-2">Beschikbaarheid</label>
                <select name="beschikbaarheid" id="beschikbaarheid" class="w-full p-2 border border-gray-300 rounded-lg"
                    required>
                    <option value="Full-time" {{ old('beschikbaarheid') == 'Full-time' ? 'selected' : '' }}>
                        Full-time</option>
                    <option value="Part-time" {{ old('beschikbaarheid') == 'Part-time' ? 'selected' : '' }}>
                        Part-time</option>
                    <option value="Freelance" {{ old('beschikbaarheid') == 'Freelance' ? 'selected' : '' }}>
                        Freelance</option>
                    <option value="On-call" {{ old('beschikbaarheid') == 'On-call' ? 'selected' : '' }}>
                        On-call</option>
                </select>
                @if ($errors->has('beschikbaarheid'))
                    <div class="p-2 mb-2 text-red-700 bg-red-100 rounded-b alert alert-danger">
                        {{ $errors->first('beschikbaarheid') }}
                    </div>
                @endif

            </div>
            <button type="submit"
                class="w-full p-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
        </form>
    </div>
</body>

</html>
