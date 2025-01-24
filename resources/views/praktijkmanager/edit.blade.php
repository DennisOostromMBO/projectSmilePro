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

        <h1 class="mb-6 text-2xl font-bold">Medewerker Bewerken</h1>

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

        @if ($medewerker == null)
            <h3 class="text-red-500">Momenteel geen medewerker gegevens beschikbaar</h3>
        @else
            <form action="{{ route('medewerkers.update', $medewerker->Id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="voornaam" class="block mb-2">Naam</label>
                    <input type="text" name="voornaam" id="voornaam"
                        value="{{ old('voornaam', $medewerker->persoon->Voornaam) }}"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @if ($errors->has('voornaam'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('voornaam') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="tussenvoegsel" class="block mb-2">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel"
                        value="{{ old('tussenvoegsel', $medewerker->persoon->Tussenvoegsel) }}"
                        class="w-full p-2 border border-gray-300 rounded-lg">
                    @if ($errors->has('tussenvoegsel'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('tussenvoegsel') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="achternaam" class="block mb-2">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam"
                        value="{{ old('achternaam', $medewerker->persoon->Achternaam) }}"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @if ($errors->has('achternaam'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('achternaam') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="geboortedatum" class="block mb-2">Geboortedatum</label>
                    <input type="date" class="w-full p-2 border border-gray-300 rounded-lg" id="geboortedatum"
                        name="geboortedatum" value="{{ old('geboortedatum', $medewerker->persoon->Geboortedatum) }}"
                        required>
                    @if ($errors->has('geboortedatum'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('geboortedatum') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="nummer" class="block mb-2">Nummer</label>
                    <input type="text" name="nummer" id="nummer"
                        value="{{ old('nummer', $medewerker->Nummer) }}"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @if ($errors->has('nummer'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('nummer') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="medewerkertype" class="block mb-2">Medewerkertype</label>
                    <select name="medewerkertype" id="medewerkertype"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="Assistent" {{ $medewerker->Medewerkertype == 'Assistent' ? 'selected' : '' }}>
                            Assistent</option>
                        <option value="Mondhygiënist"
                            {{ $medewerker->Medewerkertype == 'Mondhygiënist' ? 'selected' : '' }}>Mondhygiënist
                        </option>
                        <option value="Tandarts" {{ $medewerker->Medewerkertype == 'Tandarts' ? 'selected' : '' }}>
                            Tandarts</option>
                        <option value="Praktijkmanagement"
                            {{ $medewerker->Medewerkertype == 'Praktijkmanagement' ? 'selected' : '' }}>
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
                        value="{{ old('specialisatie', $medewerker->Specialisatie) }}"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                    @if ($errors->has('specialisatie'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('specialisatie') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="beschikbaarheid" class="block mb-2">Beschikbaarheid</label>
                    <select name="beschikbaarheid" id="beschikbaarheid"
                        class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="Full-time" {{ $medewerker->Beschikbaarheid == 'Full-time' ? 'selected' : '' }}>
                            Full-time</option>
                        <option value="Part-time" {{ $medewerker->Beschikbaarheid == 'Part-time' ? 'selected' : '' }}>
                            Part-time</option>
                        <option value="Freelance" {{ $medewerker->Beschikbaarheid == 'Freelance' ? 'selected' : '' }}>
                            Freelance</option>
                        <option value="On-call" {{ $medewerker->Beschikbaarheid == 'On-call' ? 'selected' : '' }}>
                            On-call</option>
                    </select>
                    @if ($errors->has('beschikbaarheid'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded-b alert alert-danger">
                            {{ $errors->first('beschikbaarheid') }}
                        </div>
                    @endif
                </div>

                {{-- ContractVerloopdatum --}}
                <div class="mb-4">
                    <label for="contractverloopdatum" class="block mb-2">Contract Verloopdatum</label>
                    <input type="date" class="w-full p-2 border border-gray-300 rounded-lg"
                        id="contractverloopdatum" name="contractverloopdatum"
                        value="{{ old('contractverloopdatum', $medewerker->ContractVerloopdatum) }}" required>
                    @if ($errors->has('contractverloopdatum'))
                        <div class="p-2 mb-2 text-red-700 bg-red-100 rounded alert alert-danger">
                            {{ $errors->first('contractverloopdatum') }}
                        </div>
                    @endif
                </div>

                <button type="submit"
                    class="w-full p-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Opslaan</button>
            </form>
        @endif
    </div>
</body>

</html>
