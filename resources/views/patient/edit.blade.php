<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patiënt Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .input-container {
            position: relative;
        }

        .error-message {
            position: absolute;
            top: -20px; 
            left: 0;
            color: #e53e3e;
            font-size: 0.875rem; 
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <h1 class="text-3xl font-bold mb-6 text-center">Bewerk Patiënt gegevens</h1>
        <form action="{{ route('patient.update', ['id' => $patient->Id]) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->has('email_exists'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong>Let op!</strong> {{ $errors->first('email_exists') }}
            </div>
        @endif
        
        @if ($errors->has('mobiel_exists'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong>Let op!</strong> {{ $errors->first('mobiel_exists') }}
            </div>
        @endif
        
            <!-- Persoonlijke Gegevens Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Persoonlijke Gegevens</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Voornaam')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Voornaam" class="block text-sm font-medium text-gray-700">Voornaam</label>
                        <input type="text" id="Voornaam" name="Voornaam" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Voornaam van patiënt" value="{{ old('Voornaam', $patient->persoon->Voornaam) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Tussenvoegsel')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Tussenvoegsel" class="block text-sm font-medium text-gray-700">Tussenvoegsel</label>
                        <input type="text" id="Tussenvoegsel" name="Tussenvoegsel" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Tussenvoegsel van patiënt" value="{{ old('Tussenvoegsel', $patient->persoon->Tussenvoegsel) }}">
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Achternaam')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Achternaam" class="block text-sm font-medium text-gray-700">Achternaam</label>
                        <input type="text" id="Achternaam" name="Achternaam" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Achternaam van patiënt" value="{{ old('Achternaam', $patient->persoon->Achternaam) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Geboortedatum')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Geboortedatum" class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                        <input type="date" id="Geboortedatum" name="Geboortedatum" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Geboortedatum van patiënt" value="{{ old('Geboortedatum', $patient->persoon->Geboortedatum) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Mobiel')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Mobiel" class="block text-sm font-medium text-gray-700">Mobielnummer</label>
                        <input type="tel" id="Mobiel" name="Mobiel" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Mobielnummer van patiënt" value="{{ old('Mobiel', $patient->contact->Mobiel) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                        <input type="email" id="Email" name="Email" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Emailadres van patiënt" value="{{ old('Email', $patient->contact->Email) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('MedischDossier')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="MedischDossier" class="block text-sm font-medium text-gray-700">Medisch Dossier</label>
                        <textarea id="MedischDossier" name="MedischDossier" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Medisch dossier van patiënt" >{{ old('MedischDossier', $patient->MedischDossier) }}</textarea>
                    </div>
                </div>
            </div>
        
            <!-- Adres Sectie -->
            <div class="space-y-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-700">Adres Informatie</h2>
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Postcode')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                        <input type="text" id="Postcode" name="Postcode" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Postcode" value="{{ old('Postcode', $patient->contact->Postcode) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Plaats')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Plaats" class="block text-sm font-medium text-gray-700">Plaats</label>
                        <input type="text" id="Plaats" name="Plaats" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Plaats" value="{{ old('Plaats', $patient->contact->Plaats) }}" required>
                    </div>
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Huisnummer')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Huisnummer" class="block text-sm font-medium text-gray-700">Huisnummer</label>
                        <input type="text" id="Huisnummer" name="Huisnummer" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Huisnummer" value="{{ old('Huisnummer', $patient->contact->Huisnummer) }}" required>
                    </div>
        
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Toevoeging')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Toevoeging" class="block text-sm font-medium text-gray-700">Toevoeging</label>
                        <input type="text" id="Toevoeging" name="Toevoeging" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Toevoeging (bijv. A, B)" value="{{ old('Toevoeging', $patient->contact->Toevoeging) }}">
                    </div>
                    <div class="mb-4 input-container">
                        <!-- Error Message -->
                        @error('Straatnaam')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <label for="Straatnaam" class="block text-sm font-medium text-gray-700">Straatnaam</label>
                        <input type="text" id="Straatnaam" name="Straatnaam" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Straatnaam" value="{{ old('Straatnaam', $patient->contact->Straatnaam) }}" required>
                    </div>
                </div>
            </div>
        
            <!-- Opslaan Button -->
            <div class="flex justify-end items-center space-x-4">
                <a href="{{ route('patient.index') }}" class="bg-gray-100 text-blue-500 px-6 py-2 rounded-lg hover:bg-gray-200 border border-gray-300">
                    Terug naar Overzicht
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Opslaan
                </button>
            </div>            
        </form>
    </div>
</body>
</html>
