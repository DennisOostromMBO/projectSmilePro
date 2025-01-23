<!-- filepath: /C:/Users/danie/OneDrive/Documenten/school mappen/Leerjaar 2/Project/Periode 2/projectSmilePro/resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-gray-800">
                <strong>{{ Auth::user()->voornaam }} {{ Auth::user()->tussenvoegsel }} {{ Auth::user()->achternaam }}</strong>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                @if (session('status'))
                    <div class="p-6 text-green-500">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="p-6 text-gray-900">
                    <p><strong>Volledige Naam:</strong> {{ Auth::user()->voornaam }} {{ Auth::user()->tussenvoegsel }} {{ Auth::user()->achternaam }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <br>
                    <a href="{{ route('profile.edit') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Gegevens bewerken</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>