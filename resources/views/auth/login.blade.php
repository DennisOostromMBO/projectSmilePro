<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Gebruikersnaam -->
        <div>
            <x-input-label for="gebruikersnaam" :value="__('Gebruikersnaam')" />
            <x-text-input id="gebruikersnaam" class="block mt-1 w-full" type="text" name="gebruikersnaam" :value="old('gebruikersnaam')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('gebruikersnaam')" class="mt-2" />
        </div>

        <!-- Wachtwoord -->
        <div class="mt-4">
            <x-input-label for="Wachtwoord" :value="__('Wachtwoord')" />
            <x-text-input id="Wachtwoord" class="block mt-1 w-full" type="password" name="Wachtwoord" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('Wachtwoord')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Foutmeldingen -->
        @if ($errors->any())
            <div class="mt-4">
                <div class="font-medium text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</x-guest-layout>