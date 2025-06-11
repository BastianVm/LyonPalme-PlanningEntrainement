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

        <label>Entraîneur :</label>
        <select name="id_entraineur" required>
            @foreach($entraineurs as $entraineur)
                <option value="{{ $entraineur->id }}" {{ $seance->id_entraineur == $entraineur->id ? 'selected' : '' }}>
                    {{ $entraineur->name }}
                </option>
            @endforeach
        </select>
        @error('id_entraineur') <div>{{ $message }}</div> @enderror

        <button type="submit">Enregistrer</button>
    </form>
@endsection