<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Overzicht</title>
    <!-- Voeg Tailwind CSS toe voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function confirmDeletion(event) {
            if (!confirm('Wilt u zeker dit account verwijderen?')) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-lg shadow-lg w-full max-w-6xl">
        <!-- Link om terug te keren naar de homepagina -->
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Home</a>

        <!-- Titel van de pagina -->
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Accounts</h1>

        <!-- Foutmelding weergeven als er een fout is opgetreden -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Bericht weergeven als er geen accounts beschikbaar zijn -->
        @if($gebruikers->isEmpty())
            <h3 class="text-red-500 text-lg">Er zijn geen accounts beschikbaar om weer te geven.</h3>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Naam</th>
                            <th class="py-2 px-4 border-b text-left">E-mail</th>
                            <th class="py-2 px-4 border-b text-left">Rol</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Acties</th>
                        </tr>
                    </thead>
            
<tbody>
    @foreach ($gebruikers as $gebruiker)
        <tr>
            <td class="py-2 px-4 border-b">{{ $gebruiker->persoon ? $gebruiker->persoon->VolledigeNaam : 'N/A' }}</td>
            <td class="py-2 px-4 border-b">{{ $gebruiker->email }}</td>
            <td class="py-2 px-4 border-b">{{ $gebruiker->rol ? $gebruiker->rol->Naam : 'N/A' }}</td>
            <td class="py-2 px-4 border-b">
                @if($gebruiker->isOnline())
                    <span class="text-green-500">Ingelogd</span>
                @else
                    <span class="text-red-500">Uitgelogd</span>
                @endif
            </td>
            <td class="py-2 px-4 border-b">
                <a href="{{ route('accountoverzicht.edit', $gebruiker->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Wijzigen</a>
                <form action="{{ route('accountoverzicht.destroy', $gebruiker->id) }}" method="POST" style="display:inline;" onsubmit="confirmDeletion(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Verwijderen</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>