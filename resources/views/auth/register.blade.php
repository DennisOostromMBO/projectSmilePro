<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Voornaam -->
        <div>
            <x-input-label for="voornaam" :value="__('Voornaam')" />
            <x-text-input id="voornaam" class="block mt-1 w-full" type="text" name="voornaam" :value="old('voornaam')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('voornaam')" class="mt-2" />
        </div>

        <!-- Tussenvoegsel -->
        <div class="mt-4">
            <x-input-label for="tussenvoegsel" :value="__('Tussenvoegsel')" />
            <x-text-input id="tussenvoegsel" class="block mt-1 w-full" type="text" name="tussenvoegsel" :value="old('tussenvoegsel')" autocomplete="additional-name" />
            <x-input-error :messages="$errors->get('tussenvoegsel')" class="mt-2" />
        </div>

        <!-- Achternaam -->
        <div class="mt-4">
            <x-input-label for="achternaam" :value="__('Achternaam')" />
            <x-text-input id="achternaam" class="block mt-1 w-full" type="text" name="achternaam" :value="old('achternaam')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('achternaam')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Heeft u al een account?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
