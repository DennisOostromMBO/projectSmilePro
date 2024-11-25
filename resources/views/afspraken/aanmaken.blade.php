@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nieuwe Afspraak Maken</h1>
    <form action="{{ route('afspraken.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="gebruiker_id" class="form-label">Gebruiker ID</label>
            <input type="number" class="form-control" id="gebruiker_id" name="gebruiker_id" required>
        </div>
        <div class="mb-3">
            <label for="datum" class="form-label">Datum</label>
            <input type="date" class="form-control" id="datum" name="datum" required>
        </div>
        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd</label>
            <input type="time" class="form-control" id="tijd" name="tijd" required>
        </div>
        <div class="mb-3">
            <label for="notities" class="form-label">Notities</label>
            <textarea class="form-control" id="notities" name="notities" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Opslaan</button>
    </form>
</div>
@endsection
