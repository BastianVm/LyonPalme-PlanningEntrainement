@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un entraînement</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('entrainements.store') }}">
        @csrf

        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required>
            @error('titre')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="id_seance">Séance</label>
            <select name="id_seance" id="id_seance" required>
                <option value="">-- Choisir une séance --</option>
                @foreach($seances as $seance)
                    <option value="{{ $seance->id_seance }}" {{ old('id_seance') == $seance->id_seance ? 'selected' : '' }}>
                        {{ $seance->id_seance }}
                    </option>
                @endforeach
            </select>
            @error('id_seance')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="id_entraineur">Entraîneur</label>
            <select name="id_entraineur" id="id_entraineur" required>
                <option value="">-- Choisir un entraîneur --</option>
                @foreach($entraineurs as $entraineur)
                    <option value="{{ $entraineur->id_entraineur }}" {{ old('id_entraineur') == $entraineur->id_entraineur ? 'selected' : '' }}>
                        {{ $entraineur->nom ?? $entraineur->name ?? 'Nom inconnu' }}
                    </option>
                @endforeach
            </select>
            @error('id_entraineur')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" style="padding: 10px 20px; background: #38b2ac; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Créer
        </button>
    </form>
</div>
@endsection