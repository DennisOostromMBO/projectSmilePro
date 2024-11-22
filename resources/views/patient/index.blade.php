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
            <th>Volledige naam</th>
            <th>Geboortedatum</th>
            <th>Volledig adres</th>
            <th>Mobielnummer</th>
            <th>Email</th>
            <th>Nummer</th>
            <th>Medisch Dossier</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->persoon->VolledigeNaam }}</td>
                <td>{{ $patient->persoon->Geboortedatum }}</td>
                <td>{{ $patient->contact->VolledigAdres }}</td>
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
