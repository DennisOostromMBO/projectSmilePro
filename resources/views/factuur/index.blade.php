<!DOCTYPE html>
<html>
<head>
    <title>Factuur Overzicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Factuur Overzicht</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Klant ID</th>
                <th>Beschrijving</th>
                <th>Vervaldatum</th>
                <th>BTW</th>
                <th>Totaal Bedrag</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factuur as $factuur)
                <tr>
                    <td>{{ $factuur->id }}</td>
                    <td>{{ $factuur->klant_id }}</td>
                    <td>{{ $factuur->beschrijving }}</td>
                    <td>{{ $factuur->vervaldatum }}</td>
                    <td>{{ $factuur->btw }}</td>
                    <td>{{ $factuur->totaal_bedrag }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
