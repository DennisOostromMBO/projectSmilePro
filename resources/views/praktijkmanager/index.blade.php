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
        <div class="flex items-center justify-between w-full">
            <a href="{{ url('/') }}" class="inline-block mb-4 text-blue-500 hover:underline">Terug naar Home</a>

            <a href="{{ route('medewerkers.create') }}"
                class="p-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 ">Nieuwe
                Medewerker Toevoegen</a>
        </div>

        <h1 class="mb-6 text-2xl font-bold">Overzicht Medewerkers</h1>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (count($medewerkers) <= 0 || $medewerkers == null || $medewerkers->isEmpty())
            <h3 class="text-red-500">Momenteel geen medewerker gegevens beschikbaar</h3>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="text-left">
                        <th class="px-2 py-2 border-b">Id</th>
                        <th class="px-2 py-2 border-b">Volledige Naam</th>
                        <th class="px-2 py-2 border-b">Leeftijd</th>
                        <th class="px-2 py-2 border-b">Nummer</th>
                        <th class="px-2 py-2 border-b">Medewerkertype</th>
                        <th class="px-2 py-2 border-b">Specialisatie</th>
                        <th class="px-2 py-2 border-b">Beschikbaarheid</th>
                        {{-- <th class="px-2 py-2 border-b">IsActive</th> --}}
                        {{-- <th class="px-2 py-2 border-b">Comments</th> --}}
                        <th class="px-2 py-2 border-b">Acties</th>
                        {{-- <th class="px-3 py-2 border-b">Aangemaakt Op</th>
                        <th class="px-3 py-2 border-b">Bijgewerkt Op</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medewerkers as $medewerker)
                        <tr class=" hover:bg-gray-100">
                            <td class="px-4 py-2 border-b">{{ $medewerker->Id }}</td>
                            <td class="px-4 py-2 border-b">{{ $medewerker->persoon->Voornaam }}
                                {{ $medewerker->persoon->Tussenvoegsel ?? '' }}
                                {{ $medewerker->persoon->Achternaam }}</td>
                            <td class="px-4 py-2 border-b">
                                {{ $medewerker->persoon->getAge() }}</td>
                            <td class="px-4 py-2 border-b">{{ $medewerker->Nummer }}</td>
                            <td class="px-4 py-2 border-b">{{ $medewerker->Medewerkertype }}</td>
                            <td class="px-4 py-2 border-b">{{ $medewerker->Specialisatie }}</td>
                            <td class="px-4 py-2 border-b">{{ $medewerker->Beschikbaarheid }}</td>
                            {{-- <td class="px-4 py-2 border-b">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $medewerker->IsActive ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $medewerker->IsActive ? 'Actief' : 'Inactief' }}
                                </span>
                            </td> --}}
                            {{-- <td class="px-4 py-2 border-b">{{ $medewerker->Comments ?? 'Geen' }}</td> --}}
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('medewerkers.edit', $medewerker->Id) }}"
                                    class="px-2 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Bewerken</a>
                            </td>
                            {{-- <td class="px-4 py-2 border-b">
                                {{ \Carbon\Carbon::parse($medewerker->CreatedAt)->format('d-m-Y H:i') }}</td>

                            <td class="px-4 py-2 border-b">
                                {{ \Carbon\Carbon::parse($medewerker->UpdatedAt)->format('d-m-Y H:i') }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
