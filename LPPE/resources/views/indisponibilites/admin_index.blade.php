@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; margin-top: 30px;">
        {{ __('Gestion des indisponibilités') }}
    </h2>
    @if(session('success'))
        <div style="color: green; text-align:center; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table" style="width:100%; text-align:center;">
            <thead>
                <tr>
                    <th style="text-align:center;">Entraîneur</th>
                    <th style="text-align:center;">Entraînement</th>
                    <th style="text-align:center;">Séance</th>
                    <th style="text-align:center;">Motif</th>
                    <th style="text-align:center;">Remplaçant proposé</th>
                    <th style="text-align:center;">Statut</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($indisponibilites as $indispo)
                    @if($indispo->statut !== 'validée')
                        <tr>
                            <td style="text-align:center;">{{ $indispo->entraineur->nom ?? 'Non défini' }}</td>
                            <td style="text-align:center;">{{ $indispo->entrainementViaSeance->titre ?? 'Non défini' }}</td>
                            <td style="text-align:center;">{{ $indispo->seance->date_seance ?? 'Non défini' }}</td>
                            <td style="text-align:center;">{{ $indispo->motif }}</td>
                            <td style="text-align:center;">{{ $indispo->id_entraineur_remplacant ? $indispo->remplacant->nom : 'Aucun' }}</td>
                            <td style="text-align:center;">{{ $indispo->statut }}</td>
                            <td style="text-align:center;">
                                <form method="POST" action="{{ route('admin.indisponibilites.update', $indispo->id_indispo) }}" style="display: flex; align-items: center; gap: 8px;">
                                    @csrf
                                    @method('PUT')
                                    <select name="statut" class="form-select form-select-sm">
                                        <option value="en attente" @selected($indispo->statut == 'en attente')>En attente</option>
                                        <option value="validée" @selected($indispo->statut == 'validée')>Validée</option>
                                        <option value="refusée" @selected($indispo->statut == 'refusée')>Refusée</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection