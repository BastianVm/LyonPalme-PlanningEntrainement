@extends('layouts.app')

@section('content')
    <h1>Proposer un échange d'entraînement</h1>
    @if(session('success'))
        <div style="background: #38c172; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #e3342f; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Entraîneur</th>
                <th>Séance</th>
                <th>Date</th>
                <th>Motif</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($indispos as $indispo)
            @if(is_null($indispo->id_entraineur_remplacant))
                <tr>
                <td>{{ $indispo->entraineur->nom ?? 'Non défini' }}</td>
                <td>{{ $indispo->seance->entrainement->titre ?? 'Non défini' }}</td>
                <td>{{ $indispo->seance->date_seance ?? 'Non définie' }}</td>
                <td>{{ $indispo->motif }}</td>
                <td>
                    <form method="POST" action="{{ route('indisponibilites.proposerEchange', $indispo->id_indispo) }}">
                        @csrf
                        <button type="submit" style="padding: 10px 20px; background: #ffb300; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Proposer un échange
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
</tbody>
    </table>
@endsection