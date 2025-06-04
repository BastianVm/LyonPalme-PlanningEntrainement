@extends('layouts.app')

@section('content')
    <h1>Modifier la séance</h1>
    <form action="{{ route('seances.updateDirect', $seance->id_seance) }}" method="POST">
        @csrf

        <label>Date :</label>
        <input type="date" name="date_seance" value="{{ old('date_seance', $seance->date_seance) }}" required>
        @error('date_seance') <div>{{ $message }}</div> @enderror

        <label>Heure début :</label>
        <input type="time" name="heure_debut" value="{{ old('heure_debut', $seance->heure_debut) }}" required>
        @error('heure_debut') <div>{{ $message }}</div> @enderror

        <label>Heure fin :</label>
        <input type="time" name="heure_fin" value="{{ old('heure_fin', $seance->heure_fin) }}" required>
        @error('heure_fin') <div>{{ $message }}</div> @enderror

        <label>ID Planning :</label>
        <input type="number" name="id_planning" value="{{ old('id_planning', $seance->id_planning) }}" required>
        @error('id_planning') <div>{{ $message }}</div> @enderror

        <!-- Ajoute ici d'autres champs si besoin -->

        <button type="submit">Enregistrer</button>
    </form>
@endsection