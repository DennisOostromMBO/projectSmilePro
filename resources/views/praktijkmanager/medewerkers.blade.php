<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="p-6 mx-auto bg-white rounded-lg shadow-lg max-w-7xl">

        <h1 class="mb-6 text-3xl font-semibold text-gray-800">Medewerkers</h1>
        <table class="w-full min-w-full overflow-x-scroll bg-white border-collapse table-auto">
            <thead>
                <tr class="text-left bg-gray-200">
                    <th>Id</th>
                    <th>Volledige Naam</th>
                    <th>Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Geboortedatum</th>
                    <th>Nummer</th>
                    <th>Medewerkertype</th>
                    <th>Specialisatie</th>
                    <th>Beschikbaarheid</th>
                    <th>IsActive</th>
                    <th>Comments</th>
                    <th>CreatedAt</th>
                    <th>UpdatedAt</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medewerkers as $medewerker)
                    <tr class="border-b hover:bg-gray-100">
                        <td>{{ $medewerker->Id }}</td>
                        <td>{{ $medewerker->persoon->Voornaam }}</td>
                        <td>{{ $medewerker->persoon->Tussenvoegsel }}</td>
                        <td>{{ $medewerker->persoon->Achternaam }}</td>
                        <td>{{ $medewerker->persoon->Geboortedatum }}</td>
                        <td>{{ $medewerker->Nummer }}</td>
                        <td>{{ $medewerker->Medewerkertype }}</td>
                        <td>{{ $medewerker->Specialisatie }}</td>
                        <td>{{ $medewerker->Beschikbaarheid }}</td>
                        <td>{{ $medewerker->IsActive }}</td>
                        <td>{{ $medewerker->Comments }}</td>
                        <td>{{ $medewerker->CreatedAt }}</td>
                        <td>{{ $medewerker->UpdatedAt }}</td>
                        <td>
                            {{-- {{ route('medewerkers.edit', $medewerker->Id) }} --}}
                            <a href="#" class="p-2 text-blue-500 hover:text-blue-700">Bewerken</a>
                            {{-- {{ route('medewerkers.destroy', $medewerker->Id) }} --}}
                            <form action="" method="POST" class="p-2 text-blue-500 hover:text-blue-700">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <a href="{{ route('medewerkers.create') }}">Nieuwe medewerker toevoegen</a> --}}
</body>

</html>
