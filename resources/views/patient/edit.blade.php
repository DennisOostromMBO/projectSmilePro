@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Patiënt Bewerken</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->has('email_exists'))
            <div class="alert alert-danger">
                <strong>Let op!</strong> {{ $errors->first('email_exists') }}
            </div>
        @endif

        @if ($errors->has('mobiel_exists'))
            <div class="alert alert-danger">
                <strong>Let op!</strong> {{ $errors->first('mobiel_exists') }}
            </div>
        @endif

        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="voornaam" name="voornaam" value="{{ old('voornaam', $patient->persoon->voornaam) }}" required>
        </div>

        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
            <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" value="{{ old('tussenvoegsel', $patient->persoon->tussenvoegsel) }}">
        </div>

        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" value="{{ old('achternaam', $patient->persoon->achternaam) }}" required>
        </div>

        <div class="mb-3">
            <label for="geboortedatum" class="form-label">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" value="{{ old('geboortedatum', $patient->persoon->geboortedatum) }}" required>
        </div>

        <div class="mb-3">
            <label for="medisch_dossier" class="form-label">Medisch Dossier</label>
            <textarea class="form-control" id="medisch_dossier" name="medisch_dossier" required>{{ old('medisch_dossier', $patient->medisch_dossier) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="straatnaam" class="form-label">Straatnaam</label>
            <input type="text" class="form-control" id="straatnaam" name="straatnaam" value="{{ old('straatnaam', $patient->straatnaam) }}" required>
        </div>

        <div class="mb-3">
            <label for="huisnummer" class="form-label">Huisnummer</label>
            <input type="text" class="form-control" id="huisnummer" name="huisnummer" value="{{ old('huisnummer', $patient->huisnummer) }}" required>
        </div>

        <div class="mb-3">
            <label for="toevoeging" class="form-label">Toevoeging</label>
            <input type="text" class="form-control" id="toevoeging" name="toevoeging" value="{{ old('toevoeging', $patient->toevoeging) }}">
        </div>

        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode', $patient->postcode) }}" required>
        </div>

        <div class="mb-3">
            <label for="plaats" class="form-label">Plaats</label>
            <input type="text" class="form-control" id="plaats" name="plaats" value="{{ old('plaats', $patient->plaats) }}" required>
        </div>

        <div class="mb-3">
            <label for="mobiel" class="form-label">Mobiel</label>
            <input type="text" class="form-control" id="mobiel" name="mobiel" value="{{ old('mobiel', $patient->mobiel) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $patient->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection
