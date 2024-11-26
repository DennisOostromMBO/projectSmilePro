<!-- resources/views/factuur_detail.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Factuur Detail</title>
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
    <h1>Factuur Detail</h1>
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $factuur->id }}</td>
        </tr>
        <tr>
            <th>Klant ID</th>
            <td>{{ $factuur->klant_id }}</td>
        </tr>
        <tr>
            <th>Beschrijving</th>
            <td>{{ $factuur->beschrijving }}</td>
        </tr>
        <tr>
            <th>Vervaldatum</th>
            <td>{{ $factuur->vervaldatum }}</td>
        </tr>
        <tr>
            <th>BTW</th>
            <td>{{ $factuur->btw }}</td>
        </tr>
        <tr>
            <th>Totaal Bedrag</th>
            <td>{{ $factuur->totaal_bedrag }}</td>
        </tr>
    </table>
    <a href="{{ route('factuur.index') }}">Back to Overview</a>
</body>
</html>
