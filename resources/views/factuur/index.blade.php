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
        .no-data {
            color: red;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var factuurIsEmpty = @json($factuur->isEmpty());
            if (factuurIsEmpty) {
                alert("Geen factuur beschikbaar");
                setTimeout(function() {
                    window.location.href = "{{ url('/') }}";
                }, 4000);
            }
        });
    </script>
    <h1>Factuur Overzicht</h1>
    @if ($factuur->isEmpty())
        <p class="no-data">Geen factuur beschikbaar</p>
    @else
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
    @endif

    <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>
</body>
</html>
