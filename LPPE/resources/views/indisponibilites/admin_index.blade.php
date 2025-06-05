@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des indisponibilités') }}
        </h2>
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Entraîneur</th>
                <th>Entraînement</th>
                <th>Séance</th>
                <th>Motif</th>
                <th>Remplaçant proposé</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indisponibilites as $indispo)
                @if($indispo->statut !== 'validée')
                    <tr>
                        <td>{{ $indispo->entraineur->nom ?? 'Non défini' }}</td>
                        <td>{{ $indispo->entrainementViaSeance->titre ?? 'Non défini' }}</td>
                        <td>{{ $indispo->seance->date_seance ?? 'Non défini' }}</td>
                        <td>{{ $indispo->motif }}</td>
                        <td>{{ $indispo->id_entraineur_remplacant ? $indispo->remplacant->nom : 'Aucun' }}</td>
                        <td>{{ $indispo->statut }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.indisponibilites.update', $indispo->id_indispo) }}">
                                @csrf
                                @method('PUT')
                                <select name="statut">
                                    <option value="en attente" @selected($indispo->statut == 'en attente')>En attente</option>
                                    <option value="validée" @selected($indispo->statut == 'validée')>Validée</option>
                                    <option value="refusée" @selected($indispo->statut == 'refusée')>Refusée</option>
                                </select>
                                <button type="submit">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection