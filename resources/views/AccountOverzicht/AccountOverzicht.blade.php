<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Overzicht</title>
    <!-- Voeg Tailwind CSS toe voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            <!-- Tabel om de lijst van gebruikers weer te geven -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Volledige Naam</th>
                            <th class="py-2 px-4 border-b text-center">Gebruikersnaam</th>
                            <th class="py-2 px-4 border-b text-center">Wachtwoord</th>
                            <th class="py-2 px-4 border-b text-center">Is Active</th>
                            <th class="py-2 px-4 border-b text-center">Is Ingelogd</th>
                            <th class="py-2 px-4 border-b text-center">Ingelogd</th>
                            <th class="py-2 px-4 border-b text-center">Uitgelogd</th>
                            <th class="py-2 px-4 border-b text-center">Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gebruikers as $gebruiker)
                            <tr>
                                <td class="py-2 px-4 border-b text-center align-middle">{{ $gebruiker->persoon->VolledigeNaam }}</td>
                                <td class="py-2 px-4 border-b text-center align-middle">{{ $gebruiker->Gebruikersnaam }}</td>
                                <td class="py-2 px-4 border-b text-center align-middle">
                                    {{ substr($gebruiker->Wachtwoord, 0, floor(strlen($gebruiker->Wachtwoord) * 0.4)) }}{{ str_repeat('*', ceil(strlen($gebruiker->Wachtwoord) * 0.6)) }}
                                </td>
                                <td class="py-2 px-4 border-b text-center align-middle"><span
                                    class="px-2 py-1 rounded-full text-xs {{ $gebruiker->IsActive ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $gebruiker->IsActive ? 'Actief' : 'Inactief' }}
                                </span></td>
                                <td class="py-2 px-4 border-b text-center align-middle"><span
                                    class="px-2 py-1 rounded-full text-xs {{ $gebruiker->Isingelogd ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $gebruiker->Isingelogd ? 'IsIngelogd' : 'NietIngelogd' }}
                                </span></td>
                                <td class="py-2 px-4 border-b text-center align-middle"><span
                                    class="px-2 py-1 rounded-full text-xs {{ $gebruiker->Ingelogd ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $gebruiker->Ingelogd ? 'Ingelogd' : 'NietIngelogd' }}
                                </span></td>
                                <td class="py-2 px-4 border-b text-center align-middle"><span
                                    class="px-2 py-1 rounded-full text-xs {{ $gebruiker->Uitgelogd ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $gebruiker->Uitgelogd ? 'Uitgelogd' : 'Ingelogd' }}
                                </span></td>
                                <td class="py-2 px-4 border-b text-center align-middle">{{ $gebruiker->Comments }}</td>
                            </tr>   
                        @endforeach 
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>