@extends('layouts.app')

@section('content')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planning des séances') }}
        </h2>
    </a>
        <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID Séance</th>
                <th>Date</th>
                <th>Heure début</th>
                <th>Heure fin</th>
                <th>Entraîneur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seances as $seance)
                <tr>
                    <td>{{ $seance->id_seance }}</td>
                    <td>{{ $seance->date_seance }}</td>
                    <td>{{ $seance->heure_debut }}</td>
                    <td>{{ $seance->heure_fin }}</td>
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
    <a href="{{ route('seances.parPeriode') }}" style="display:inline-block;padding:8px 16px;background:#007bff;color:#fff;border-radius:4px;text-decoration:none;margin-bottom:15px;">
        Filtrer par période
@endsection