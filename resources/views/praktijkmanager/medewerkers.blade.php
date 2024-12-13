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
    <div class="bg-white p-20 rounded-lg shadow-lg w-full">
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>

        <h1 class="text-2xl font-bold mb-6">Overzicht Medewerkers</h1>

        @if (count($medewerkers) <= 0 || $medewerkers == null || $medewerkers->isEmpty())
            <h3 class="text-red-500">Momenteel geen medewerker gegevens beschikbaar</h3>
        @else
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-2 border-b">Id</th>
                        <th class="py-2 px-2 border-b">Voornaam</th>
                        <th class="py-2 px-2 border-b">Tussenvoegsel</th>
                        <th class="py-2 px-2 border-b">Achternaam</th>
                        <th class="py-2 px-2 border-b">Geboortedatum</th>
                        <th class="py-2 px-2 border-b">Nummer</th>
                        <th class="py-2 px-2 border-b">Medewerkertype</th>
                        <th class="py-2 px-2 border-b">Specialisatie</th>
                        <th class="py-2 px-2 border-b">Beschikbaarheid</th>
                        <th class="py-2 px-2 border-b">IsActive</th>
                        <th class="py-2 px-2 border-b">Comments</th>
                        <th class="py-2 px-3 border-b">Aangemaakt Op</th>
                        <th class="py-2 px-3 border-b">Bijgewerkt Op</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medewerkers as $medewerker)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Id }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->persoon->Voornaam }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->persoon->Tussenvoegsel ?? '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->persoon->Achternaam }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->persoon->Geboortedatum }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Nummer }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Medewerkertype }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Specialisatie }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Beschikbaarheid }}</td>
                            <td class="py-2 px-4 border-b">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $medewerker->IsActive ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $medewerker->IsActive ? 'Actief' : 'Inactief' }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->Comments ?? 'Geen' }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->CreatedAt }}</td>
                            <td class="py-2 px-4 border-b">{{ $medewerker->UpdatedAt }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
