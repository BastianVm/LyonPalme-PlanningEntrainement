{{-- filepath: \\wsl.localhost\Debian\var\www\planningentrainements\LPPE\resources\views\seances\par_periode.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Séances sur une période</h1>
    <form method="GET" action="{{ route('seances.parPeriode') }}">
        <label>Début : <input type="date" name="debut" value="{{ $debut ?? '' }}" required></label>
        <label>Fin : <input type="date" name="fin" value="{{ $fin ?? '' }}" required></label>
        <button type="submit">Voir</button>
    </form>

    @if(isset($seances))
        @if($seances && count($seances) > 0)
            <table>
                <tr>
                    <th>Date</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Planning</th>
                </tr>
                @foreach($seances as $seance)
                    <tr>
                        <td>{{ $seance->date_seance }}</td>
                        <td>{{ $seance->heure_debut }}</td>
                        <td>{{ $seance->heure_fin }}</td>
                        <td>{{ $seance->id_planning }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Aucune séance trouvée pour cette période.</p>
        @endif
    @endif
@endsection