@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; margin-top: 30px;">
        {{ __('Planning des séances') }}
    </h2>
    <div class="table-container">
        <table class="table" style="width:100%; text-align:center;">
            <thead>
                <tr>
                    <th style="text-align:center;">ID Séance</th>
                    <th style="text-align:center;">Date</th>
                    <th style="text-align:center;">Heure début</th>
                    <th style="text-align:center;">Heure fin</th>
                    <th style="text-align:center;">Entraîneur</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seances as $seance)
                    <tr>
                        <td style="text-align:center;">{{ $seance->id_seance }}</td>
                        <td style="text-align:center;">{{ $seance->date_seance }}</td>
                        <td style="text-align:center;">{{ $seance->heure_debut }}</td>
                        <td style="text-align:center;">{{ $seance->heure_fin }}</td>
                        <td style="text-align:center;">{{ $seance->entraineur->name ?? 'Non affecté' }}</td>
                        <td style="text-align:center;">
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
    </div>
    <a href="{{ route('seances.parPeriode') }}" class="btn btn-primary" style="margin-bottom:15px;">
        Filtrer par période
    </a>
@endsection