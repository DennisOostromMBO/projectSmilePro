<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afsprakenoverzicht</title>
    <!-- Link naar TailwindCSS voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Afsprakenoverzicht</h1>

        <!-- Navigatie links naar andere pagina's -->
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
        <a href="{{ route('afspraken.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Nieuwe Afspraak Aanmaken
        </a>

        <!-- Successbericht weergeven -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Foutmeldingen weergeven -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filter voor Medewerker -->
        <div class="mb-4">
            <form method="GET" action="{{ route('afspraken.index') }}">
                <label for="medewerker" class="mr-2">Filter op Medewerker:</label>
                <select name="medewerker" id="medewerker" class="px-4 py-2 border rounded">
                    <option value="">Alle medewerkers</option>
                    @foreach ($medewerkers as $medewerker)
                        <option value="{{ $medewerker }}" @if(request('medewerker') == $medewerker) selected @endif>{{ $medewerker }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Filter</button>
            </form>
        </div>

        <!-- Bericht wanneer er geen afspraken zijn -->
        @if ($toekomstigeAfspraken->isEmpty() && $afgelopenAfspraken->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
                Er zijn geen afspraken beschikbaar. <a href="{{ route('afspraken.create') }}" class="text-blue-500 underline">Maak een nieuwe afspraak</a>.
            </div>
        @endif

        <!-- Toekomstige Afspraken -->
        @if ($toekomstigeAfspraken->isNotEmpty())
            <h2 class="text-xl font-semibold mb-4">Toekomstige Afspraken</h2>
            <table class="table-auto w-full bg-white shadow-md rounded mb-6">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">Patiënt Naam</th>
                        <th class="px-4 py-2">Medewerker Naam</th>
                        <th class="px-4 py-2">Datum</th>
                        <th class="px-4 py-2">Tijd</th>
                        <th class="px-4 py-2">Type Afspraak</th>
                        <th class="px-4 py-2">Acties</th>
                    </tr>
                </thead>
                <tbody>
                   <!-- Afspraken tabel -->
                @foreach ($toekomstigeAfspraken as $afspraak)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $afspraak->patient_naam }}</td>
                    <td class="px-4 py-2">{{ $afspraak->medewerker_naam }}</td>
                    <td class="px-4 py-2">{{ $afspraak->datum }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($afspraak->tijd)->format('H:i') }}</td>
                    <td class="px-4 py-2">{{ $afspraak->type_afspraak ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <!-- Acties -->
                        @if (\Carbon\Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd)->addMinutes(30)->isBefore(now()))
                            <!-- Als de afspraak afgelopen is, toon 'Afgelopen' -->
                            <span class="text-gray-500">Afgelopen</span>
                        @else
                            <!-- Anders toon bewerken en annuleren -->
                            <a href="{{ route('afspraken.edit', $afspraak->id) }}" class="text-blue-500 underline">Wijzigen</a>
                            <form action="{{ route('afspraken.annuleren', $afspraak->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="confirm_cancelation" id="confirm_cancelation_{{ $afspraak->id }}" value="no">
                                <button type="submit" class="text-red-500 underline ml-2" 
                                    onclick="return confirmCancellation('{{ \Carbon\Carbon::parse($afspraak->datum . ' ' . $afspraak->tijd)->toIso8601String() }}', {{ $afspraak->id }})">
                                    Annuleren
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <!-- Afgelopen Afspraken -->
        @if ($afgelopenAfspraken->isNotEmpty())
            <h2 class="text-xl font-semibold mb-4">Afgelopen Afspraken</h2>
            <table class="table-auto w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="px-4 py-2">Patiënt Naam</th>
                        <th class="px-4 py-2">Medewerker Naam</th>
                        <th class="px-4 py-2">Datum</th>
                        <th class="px-4 py-2">Tijd</th>
                        <th class="px-4 py-2">Type Afspraak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($afgelopenAfspraken as $afspraak)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $afspraak->patient_naam }}</td>
                            <td class="px-4 py-2">{{ $afspraak->medewerker_naam }}</td>
                            <td class="px-4 py-2">{{ $afspraak->datum }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($afspraak->tijd)->format('H:i') }}</td>
                            <td class="px-4 py-2">{{ $afspraak->type_afspraak ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function confirmCancellation(afspraakTijd, afspraakId) {
            var currentTime = new Date();
            var appointmentTime = new Date(afspraakTijd);
            var timeDifference = (appointmentTime - currentTime) / (1000 * 60); // in minuten

            if (timeDifference < 30) {
                // Als de afspraak binnen 30 minuten is, vraag de gebruiker om de annulering te bevestigen met extra kosten
                var result = confirm('Je probeert de afspraak te annuleren binnen 30 minuten van de geplande tijd. Dit zal €39,50 kosten. Weet je het zeker?');
                if (result) {
                    // Voeg een extra verborgen veld toe om aan te geven dat de gebruiker akkoord gaat
                    document.getElementById('confirm_cancelation_' + afspraakId).value = 'yes';
                    return true; // Formulier wordt ingediend
                } else {
                    return false; // Annuleer de actie
                }
            } else {
                // Annuleer zonder kosten
                return true;
            }
        }
    </script>
</body>

</html>
