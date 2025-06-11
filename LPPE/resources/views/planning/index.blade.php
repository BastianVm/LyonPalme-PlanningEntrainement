@extends('layouts.app')

@section('content')
    @if(auth()->user() && auth()->user()->entraineur && auth()->user()->entraineur->rôle === 'admin')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; margin-top: 30px;">
            {{ __('Planning des séances') }}
        </h2>
        <style>
            .btn { padding: 6px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; color: #fff; display: inline-block; }
            .btn-primary { background: #00b4d8; }      /* Bleu clair du logo */
            .btn-warning { background: #6f2da8; }      /* Violet du logo */
            .btn-danger { background: #00b4d8; }       /* Bleu clair du logo pour supprimer */
            .btn:hover { opacity: 0.85; }
        </style>

        <!-- Bouton pour afficher/masquer le formulaire -->
        <button class="btn btn-primary" style="margin-bottom:15px;" onclick="document.getElementById('form-seance').style.display = (document.getElementById('form-seance').style.display === 'none' ? 'block' : 'none');">
            Créer une séance
        </button>

        <!-- Formulaire de création de séance -->
        <div id="form-seance" style="display:none; margin-bottom:20px;">
            <form action="{{ route('seances.store') }}" method="POST" style="margin-top:10px;">
                @csrf
                <label for="id_seance">ID Séance :</label>
                <select name="id_seance" required>
                    @foreach($availableIds as $id)
                        <option value="{{ $id }}">{{ $id }}</option>
                    @endforeach
                </select>
                <label for="date_seance">Date :</label>
                <input type="date" name="date_seance" required>
                <label for="heure_debut">Heure début :</label>
                <input type="time" name="heure_debut" required>
                <label for="heure_fin">Heure fin :</label>
                <input type="time" name="heure_fin" required>
                <label for="id_entraineur">Entraîneur :</label>
                <select name="id_entraineur" required>
                    @foreach($entraineurs as $entraineur)
                        <option value="{{ $entraineur->id }}">{{ $entraineur->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>

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
                                <a href="{{ route('seances.edit', $seance) }}" class="btn btn-warning" style="margin-right:5px;">
                                    Modifier
                                </a>
                                <form action="{{ route('seances.destroy', $seance) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer cet entraînement ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('seances.parPeriode') }}" class="btn btn-primary" style="margin-bottom:15px;">
            Filtrer par période
        </a>
    @else
        <div style="text-align:center; margin-top:40px;">
            <h2>Accès refusé</h2>
            <p>Vous n'avez pas les droits pour accéder à cette page.</p>
        </div>
    @endif
@endsection