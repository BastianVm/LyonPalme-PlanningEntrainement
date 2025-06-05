@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des entraînements') }}
        </h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Séance</th>
                <th>Entraîneur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entrainements as $entrainement)
                <tr>
                    <td>{{ $entrainement->titre }}</td>
                    <td>{{ $entrainement->description }}</td>
                    <td>{{ $entrainement->id_seance }}</td>
                    <td>
                        {{ $entrainement->entraineur ? $entrainement->entraineur->nom ?? $entrainement->entraineur->name ?? 'Nom inconnu' : 'Non défini' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @auth
        <div style="position: fixed; bottom: 20px; left: 20px; display: flex; gap: 10px;">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('entrainements.create') }}">
                    <button style="padding: 10px 20px; background: #3490dc; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Créer un entraînement
                    </button>
                </a>
            @endif
            <form method="GET" action="{{ route('indisponibilites.create') }}">
                <button type="submit" style="padding: 10px 20px; background: #38c172; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Signaler une indisponibilité
                </button>
            </form>
            <form method="GET" action="{{ route('indisponibilites.proposerEchangeForm') }}">
                <button type="submit" style="padding: 10px 20px; background: #ffb300; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Proposer un échange
                </button>
            </form>
        </div>
    @endauth
@endsection