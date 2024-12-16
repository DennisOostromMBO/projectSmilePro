<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
                    <p><strong>Volledige Naam:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email}}</p> 
                    <br>
                    <a href="{{ route('profile.edit') }}" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Gegevens bewerken</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordSpan = document.getElementById('password');
            const hashedPassword = '{{ Auth::user()->Wachtwoord }}';
            const visiblePart = hashedPassword.substring(0, 3); // Eerste 3 tekens van het wachtwoord
            const hiddenPart = '*'.repeat(hashedPassword.length - 3); // Rest van het wachtwoord verbergen

            if (passwordSpan.innerText === 'Klik om te tonen') {
                passwordSpan.innerText = visiblePart + hiddenPart;
            } else {
                passwordSpan.innerText = 'Klik om te tonen';
            }
        }
    </script>
</x-app-layout>