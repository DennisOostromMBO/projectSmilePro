<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Bewerken</title>
    <!-- Voeg Tailwind CSS toe voor styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-12 rounded-lg shadow-lg w-full max-w-4xl">
        <!-- Link om terug te keren naar de account overzicht pagina -->
        <a href="{{ route('accountoverzicht.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">Terug naar Account Overzicht</a>

        <!-- Titel van de pagina -->
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Account Bewerken</h1>

        <!-- Formulier voor het bewerken van een account -->
        <form action="{{ route('accountoverzicht.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->has('email_exists'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                    <strong>Let op!</strong> {{ $errors->first('email_exists') }}
                </div>
            @endif

            <div class="mb-4">
                <label for="email" class="block text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 rounded mt-1" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="current_role" class="block text-gray-700">Huidige Rol</label>
                <input type="text" id="current_role" class="w-full border-gray-300 rounded mt-1" value="{{ $user->rol ? $user->rol->Naam : 'Geen rol' }}" disabled>
            </div>

            <div class="mb-4">
                <label for="rol_naam" class="block text-gray-700">Wijzig rol</label>
                <select name="rol_naam" id="rol_naam" class="w-full border-gray-300 rounded mt-1" required>
                    @foreach($rollen as $index => $rol)
                        <option value="{{ $rol->Naam }}" {{ old('rol_naam', $user->rol ? $user->rol->Naam : '') == $rol->Naam ? 'selected' : '' }}>
                            {{ $index + 1 }}. {{ $rol->Naam }}
                        </option>
                    @endforeach
                </select>
                @error('rol_naam')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Opslaan</button>
            </div>
        </form>
    </div>
</body>
</html>