<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Patiënten</title>
</head>
<body>
   <h1>Overzicht Patiënten</h1>

   @if($patients->isEmpty())
       <h3>Momenteel geen patiënt gegevens beschikbaar</h3>
   @else
   <table border="1">
    <thead>
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Geboortedatum</th>
            <th>Straatnaam</th>
            <th>Huisnummer</th>
            <th>Toevoeging</th>
            <th>Postcode</th>
            <th>Straat</th>
            <th>Mobielnummer</th>
            <th>Email</th>
            <th>Nummer</th>
            <th>Medisch Dossier</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->persoon->Voornaam }}</td>
                <td>{{ $patient->persoon->Tussenvoegsel }}</td>
                <td>{{ $patient->persoon->Achternaam }}</td>
                <td>{{ $patient->persoon->Geboortedatum }}</td>
                <td>{{ $patient->contact->Straatnaam }}</td>
                <td>{{ $patient->contact->Huisnummer }}</td>
                <td>{{ $patient->contact->Toevoeging }}</td>
                <td>{{ $patient->contact->Postcode }}</td>
                <td>{{ $patient->contact->Plaats }}</td>
                <td>{{ $patient->contact->Mobiel }}</td>
                <td>{{ $patient->contact->Email }}</td>
                <td>{{ $patient->Nummer }}</td>
                <td>{{ $patient->MedischDossier }}</td>   
            </tr>
        @endforeach
    </tbody>
</table>
   @endif
   <a href="{{ url('/') }}">Terug naar Home</a>
</body>
</html>
