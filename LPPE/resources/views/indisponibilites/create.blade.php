@extends('layouts.app')

@section('content')
    <h1>Signaler une indisponibilité</h1>
    <form method="POST" action="{{ route('indisponibilites.store') }}">
        @csrf
        <div>
            <label for="id_entrainement">Choisissez l'entraînement concerné :</label>
            <select name="id_entrainement" required>
                @foreach($entrainements as $entrainement)
                    <option value="{{ $entrainement->id_entrainement }}">{{ $entrainement->titre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="motif">Motif :</label>
            <textarea name="motif" required></textarea>
        </div>
        <button type="submit" style="margin-top: 10px; padding: 8px 16px; background: #38c172; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Envoyer
        </button>
    </form>
@endsection