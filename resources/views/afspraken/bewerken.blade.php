<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraak Wijzigen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afspraak Wijzigen</h1>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <a href="{{ url('/afspraken') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Terug naar Overzicht
        </a>
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
        
        @if (session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
        @endif


        <form action="{{ route('afspraken.update', $afspraak->id) }}" method="POST" class="bg-white shadow-md rounded p-6">
            @csrf
            @method('PUT')
            
            <!-- Patient Naam - Alleen-Lezen met andere kleur -->
            <div class="mb-4">
                <label for="patient_naam" class="block text-gray-700">Patient Naam</label>
                <input type="text" id="patient_naam" name="patient_naam" value="{{ $afspraak->patient_naam }}" class="w-full p-2 border rounded bg-gray-200 text-gray-500" readonly>
            </div>

            <!-- Medewerker Naam - Alleen-Lezen met andere kleur -->
            <div class="mb-4">
                <label for="medewerker_naam" class="block text-gray-700">Medewerker Naam</label>
                <input type="text" id="medewerker_naam" name="medewerker_naam" value="{{ $afspraak->medewerker_naam }}" class="w-full p-2 border rounded bg-gray-200 text-gray-500" readonly>
            </div>

            <!-- Datum - Maximaal 1 jaar in de toekomst -->
            <div class="mb-4">
                <label for="datum" class="block text-gray-700">Datum</label>
                <input type="date" id="datum" name="datum" value="{{ old('datum', $afspraak->datum) }}" class="w-full p-2 border rounded" min="{{ \Carbon\Carbon::today()->toDateString() }}" max="{{ \Carbon\Carbon::today()->addYear()->toDateString() }}" required>
            </div>

            <!-- Tijd - Alleen Keuzes per 30 Minuten tot 16:30 -->
            <div class="mb-4">
                <label for="tijd" class="block text-gray-700">Tijd</label>
                <select id="tijd" name="tijd" class="w-full p-2 border rounded" required>
                    @php
                        $times = [];
                        $start = \Carbon\Carbon::createFromFormat('H:i', '08:00');
                        $end = \Carbon\Carbon::createFromFormat('H:i', '16:30');
                        while ($start <= $end) {
                            $times[] = $start->format('H:i');
                            $start->addMinutes(30);
                        }
                    @endphp
                    @foreach ($times as $time)
                        <option value="{{ $time }}" {{ old('tijd', $afspraak->tijd) == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type Afspraak - Keuze Dropdown -->
            <div class="mb-4">
                <label for="type_afspraak" class="block text-gray-700">Type Afspraak</label>
                <select id="type_afspraak" name="type_afspraak" class="w-full p-2 border rounded">
                    <option value="Consult" {{ old('type_afspraak', $afspraak->type_afspraak) == 'Consult' ? 'selected' : '' }}>Consult</option>
                    <option value="Controle" {{ old('type_afspraak', $afspraak->type_afspraak) == 'Controle' ? 'selected' : '' }}>Controle</option>
                    <option value="Therapie" {{ old('type_afspraak', $afspraak->type_afspraak) == 'Therapie' ? 'selected' : '' }}>Therapie</option>
                    <option value="Overleg" {{ old('type_afspraak', $afspraak->type_afspraak) == 'Overleg' ? 'selected' : '' }}>Overleg</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const datumInput = document.querySelector('input[name="datum"]');
            const tijdInput = document.querySelector('select[name="tijd"]');
            const selectedDateTime = moment(datumInput.value + ' ' + tijdInput.value, 'YYYY-MM-DD HH:mm');

            // Controleer of de geselecteerde datum en tijd in het verleden liggen
            if (selectedDateTime.isBefore(moment())) {
                e.preventDefault();
                alert('Je kunt een afspraak niet naar een tijd in het verleden verplaatsen.');
            }
        });
    </script>

    <!-- Include moment.js -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
</body>
</html>
