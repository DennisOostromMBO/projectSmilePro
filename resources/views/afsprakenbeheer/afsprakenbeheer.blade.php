@extends('layouts.app')

@section('content')
    <h1>Afsprakenbeheer</h1>
    <table>
        <thead>
            <tr>
                <th>Datum</th>
                <th>Tijd</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($afspraken as $afspraak)
                <tr>
                    <td>{{ $afspraak->Datum }}</td>
                    <td>{{ $afspraak->Tijd }}</td>
                    <td>{{ $afspraak->Status }}</td>
                    <td><a href="{{ route('afsprakenbeheer.show', $afspraak->id) }}">Details</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
