<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Medewerkers</h1>
    <table>
        <tr>
            <th>Naam</th>
            <th>Geboortedatum</th>
            <th>Telefoonnummer</th>
            <th>Email</th>
            <th>Acties</th>
        </tr>
        @foreach ($medewerkers as $medewerker)
            <tr>
                <td>{{ $medewerker->naam }}</td>
                <td>{{ $medewerker->geboortedatum }}</td>
                <td>{{ $medewerker->telefoonnummer }}</td>
                <td>{{ $medewerker->email }}</td>
                <td>
                    <a href="{{ route('medewerkers.edit', $medewerker->id) }}">Bewerken</a>
                    <form action="{{ route('medewerkers.destroy', $medewerker->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Verwijderen</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- <a href="{{ route('medewerkers.create') }}">Nieuwe medewerker toevoegen</a> --}}
</body>

</html>
