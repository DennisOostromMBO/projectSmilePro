<!-- filepath: /c:/Users/danie/OneDrive/Documenten/school mappen/Leerjaar 2/Project/Periode 2/projectSmilePro/resources/views/profile/partials/update-profile-information-form.blade.php -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Account Informatie') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Wijzig uw account gegevens") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" onsubmit="return confirmUpdate()">
        @csrf
        @method('patch')

        <!-- Hidden input field for user ID -->
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">

        <!-- Voornaam -->
        <div>
            <x-input-label for="voornaam" :value="__('Voornaam')" />
            <x-text-input id="voornaam" name="voornaam" type="text" class="mt-1 block w-full" :value="old('voornaam', Auth::user()->voornaam)" autofocus autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('voornaam')" />
        </div>

        <!-- Tussenvoegsel -->
        <div>
            <x-input-label for="tussenvoegsel" :value="__('Tussenvoegsel')" />
            <x-text-input id="tussenvoegsel" name="tussenvoegsel" type="text" class="mt-1 block w-full" :value="old('tussenvoegsel', Auth::user()->tussenvoegsel)" autocomplete="additional-name" />
            <x-input-error class="mt-2" :messages="$errors->get('tussenvoegsel')" />
        </div>

        <!-- Achternaam -->
        <div>
            <x-input-label for="achternaam" :value="__('Achternaam')" />
            <x-text-input id="achternaam" name="achternaam" type="text" class="mt-1 block w-full" :value="old('achternaam', Auth::user()->achternaam)" autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('achternaam')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', Auth::user()->email)" autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (Auth::user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! Auth::user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Opgeslagen') }}</p>
            @endif
        </div>
    </form>

    <script>
        function confirmUpdate() {
            return confirm('Wilt u de gegevens aanpassen?');
        }
    </script>
</section>