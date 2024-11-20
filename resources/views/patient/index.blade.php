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
                   <th>Nummer</th>
                   <th>Medisch Dossier</th>
               </tr>
           </thead>
           <tbody>
               @foreach($patients as $patient)
                   <tr>
                       <td>{{ $patient->Nummer }}</td>
                       <td>{{ $patient->MedischDossier }}</td>
                   </tr>
               @endforeach
           </tbody>
       </table>
   @endif
</body>
</html>
