
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Afsprakenbeheer</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($afspraken->isEmpty())
        <div class="alert alert-warning">
            Geen beschikbare tijden op de gekozen datum.
        </div>
    @else
        <form action="{{ route('afspraakbeheer.store') }}" method="POST">
            @csrf
            <label for="datum">Datum:</label>
            <input type="date" name="datum" required>
            
            <label for="tijd">Tijd:</label>
            <select name="tijd" required>
                @foreach($afspraken as $afspraak)
                    <option value="{{ $afspraak->tijd }}">{{ $afspraak->tijd }}</option>
                @endforeach
            </select>
            
            <button type="submit">Afspraak inplannen</button>
        </form>
    @endif
</div>
@endsection
