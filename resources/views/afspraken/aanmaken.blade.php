<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraak Aanmaken</title>
    <!-- Link naar TailwindCSS voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afspraak Aanmaken</h1>

        <!-- Navigatie links naar andere pagina's -->
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <a href="{{ url('/afspraken') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Terug naar Overzicht
        </a>

        <!-- Success en error berichten weergeven -->
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

        @if (session('success') && session('timer'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <script>
                // Navigeren naar overzicht na 3 seconden
                setTimeout(() => {
                    window.location.href = "{{ route('afspraken.index') }}";
                }, 3000); // 3 seconden
            </script>
        @endif

        <!-- Formulier voor het aanmaken van een afspraak -->
        <form action="{{ route('afspraken.store') }}" method="POST" class="bg-white shadow-md rounded p-6">
            @csrf
            <!-- Patiënt Naam invoeren -->
            <div class="mb-4">
                <label for="patient_naam" class="block text-gray-700">Patiënt Naam</label>
                <input type="text" id="patient_naam" name="patient_naam" value="{{ old('patient_naam') }}"
                    class="w-full p-2 border rounded" required>
            </div>

            <!-- Medewerker Naam selecteren -->
            <div class="mb-4">
                <input type="hidden" name="gebruiker_id" value="{{ auth()->check() ? auth()->id() : '' }}">

                <label for="medewerker_naam" class="block text-gray-700">Medewerker Naam</label>
                <select id="medewerker_naam" name="medewerker_naam" class="w-full p-2 border rounded" required>
                    @foreach ($medewerkers as $medewerker)
                        <option value="{{ $medewerker }}">{{ $medewerker }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Datum van de afspraak kiezen -->
            <div class="mb-4">
                <label for="datum" class="block text-gray-700">Datum</label>
                <input type="date" id="datum" name="datum" class="w-full p-2 border rounded"
                    min="{{ \Carbon\Carbon::today()->toDateString() }}"
                    max="{{ \Carbon\Carbon::today()->addYear()->toDateString() }}" required>
            </div>

            <!-- Tijd van de afspraak kiezen -->
            <div class="mb-4">
                <label for="tijd" class="block text-gray-700">Tijd</label>
                <select id="tijd" name="tijd" class="w-full p-2 border rounded" required>
                    @php
                        $times = [];
                        $start = \Carbon\Carbon::createFromFormat('H:i', '08:00');
                        $end = \Carbon\Carbon::createFromFormat('H:i', '16:30');
                        // Genereer tijdsloten per 30 minuten
                        while ($start <= $end) {
                            $times[] = $start->format('H:i');
                            $start->addMinutes(30);
                        }
                    @endphp
                    @foreach ($times as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type van de afspraak kiezen -->
            <div class="mb-4">
                <label for="type_afspraak" class="block text-gray-700">Type Afspraak</label>
                <select id="type_afspraak" name="type_afspraak" class="w-full p-2 border rounded">
                    <option value="Consult">Consult</option>
                    <option value="Controle">Controle</option>
                    <option value="Therapie">Therapie</option>
                    <option value="Overleg">Overleg</option>
                </select>
            </div>

            <!-- Verzendknop om de afspraak op te slaan -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Opslaan</button>
        </form>
    </div>
</body>

</html>
