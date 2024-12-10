<!-- resources/views/factuur/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Factuur Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Factuur Overzicht</h1>
        <div class="flex justify-center mb-4">
            <a href="{{ route('factuur.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Create Factuur</a>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Klant ID</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factuur as $factuur)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $factuur->id }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $factuur->klant_id }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('factuur.edit', $factuur->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
