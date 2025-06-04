@extends('layouts.app')

@section('content')
    <h1>Planning des entraînements</h1>
    
        <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure début</th>
                <th>Heure fin</th>
                <th>ID Planning</th>
                <th>Entraîneur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seances as $seance)
                <tr>
                    <td>{{ $seance->date_seance }}</td>
                    <td>{{ $seance->heure_debut }}</td>
                    <td>{{ $seance->heure_fin }}</td>
                    <td>{{ $seance->id_planning }}</td>
                    <td>{{ $seance->entraineur->name ?? 'Non affecté' }}</td>
                    <td>
                        @if(auth()->user() && auth()->user()->entraineur && auth()->user()->entraineur->rôle === 'admin')
                            <a href="{{ route('seances.edit', $seance) }}">Modifier</a>
                            <form action="{{ route('seances.destroy', $seance) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cet entraînement ?')">Supprimer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection