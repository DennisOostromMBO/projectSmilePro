<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Overzicht</title>
</head>
<body>
    <a href="{{ url('/') }}">Terug naar Home</a>

    <h1>Accounts</h1>

    @if($gebruikers->isEmpty())
        <h3>Er zijn geen accounts beschikbaar om weer te geven.</h3>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gebruikersnaam</th>
                    <th>Wachtwoord</th>
                    <th>Is Active</th>
                    <th>Is Ingelogd</th>
                    <th>Ingelogd</th>
                    <th>Uitgelogd</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gebruikers as $gebruiker)
                    <tr>
                        <td>{{ $gebruiker->id }}</td>
                        <td>{{ $gebruiker->Gebruikersnaam }}</td>
                        <td>{{ $gebruiker->Wachtwoord }}</td>
                        <td>{{ $gebruiker->IsActive }}</td>
                        <td>{{ $gebruiker->Isingelogd }}</td>
                        <td>{{ $gebruiker->Ingelogd }}</td>
                        <td>{{ $gebruiker->Uitgelogd }}</td>
                        <td>{{ $gebruiker->Comments }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>