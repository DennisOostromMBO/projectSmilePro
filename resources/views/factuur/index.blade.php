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
            </tr>
        </thead>
        <tbody>
            @foreach ($factuur as $factuur)
                <tr>
                    <td><a href="{{ route('factuur.show', $factuur->id) }}">{{ $factuur->id }}</a></td>
                    <td>{{ $factuur->klant_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
</body>
</html>
@if ($factuur->isEmpty())
    <p>Momenteel geen facturen beschikbaar</p>
    <script>
        setTimeout(function() {
            window.location.href = "{{ url('/') }}";
        }, 4000);
    </script>
@endif
