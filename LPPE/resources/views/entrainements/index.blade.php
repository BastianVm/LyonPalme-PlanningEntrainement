@extends('layouts.app')

@section('content')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: center; margin-top: 30px;">
        {{ __('Liste des entraînements') }}
    </h2>

    <!-- FullCalendar (si tu veux le garder) -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <div id='calendar' style="margin-bottom: 40px;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'fr',
                events: [
                    @foreach($entrainements as $entrainement)
                        @if($entrainement->seance && $entrainement->seance->date_seance)
                        {
                            title: @json($entrainement->titre),
                            start: @json($entrainement->seance->date_seance),
                        },
                        @endif
                    @endforeach
                ]
            });
            calendar.render();
        });
    </script>

    <style>
        .btn { padding: 6px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; color: #fff; display: inline-block; }
        .btn-primary { background: #0275d8; }
        .btn-violet { background: #6f2da8; }
        .btn-blue-light { background: #00b4d8; }
        .btn-warning { background: #f0ad4e; }
        .btn-success { background: #5cb85c; }
        .btn:hover { opacity: 0.85; }
    </style>

    <div class="table-container" style="overflow-x:auto;">
        <table class="table" style="min-width: 900px; text-align: center;">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Entraîneur</th>
                    <th>Google Agenda</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entrainements as $entrainement)
                    <tr>
                        <td style="max-width: 180px; word-break: break-word;">{{ $entrainement->titre }}</td>
                        <td style="max-width: 220px; word-break: break-word;">{{ $entrainement->description }}</td>
                        <td>
                            @if($entrainement->seance)
                                {{ $entrainement->seance->date_seance }}
                            @else
                                <span style="color: #aaa;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($entrainement->seance)
                                {{ $entrainement->seance->heure_debut }}
                            @else
                                <span style="color: #aaa;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($entrainement->seance)
                                {{ $entrainement->seance->heure_fin }}
                            @else
                                <span style="color: #aaa;">—</span>
                            @endif
                        </td>
                        <td>
                            {{ $entrainement->entraineur ? $entrainement->entraineur->nom ?? $entrainement->entraineur->name ?? 'Nom inconnu' : 'Non défini' }}
                        </td>
                        <td>
                            @php
                                $user = Auth::user();
                                $isMyEntrainement = $user && $user->id_entraineur && $entrainement->id_entraineur == $user->id_entraineur;
                                $googleUrl = '';
                                if ($isMyEntrainement && $entrainement->seance) {
                                    $date = $entrainement->seance->date_seance;
                                    $heure_debut = $entrainement->seance->heure_debut;
                                    $heure_fin = $entrainement->seance->heure_fin;
                                    if ($date && $heure_debut && $heure_fin) {
                                        $start = \Carbon\Carbon::parse($date . ' ' . $heure_debut)->format('Ymd\THis\Z');
                                        $end = \Carbon\Carbon::parse($date . ' ' . $heure_fin)->format('Ymd\THis\Z');
                                        $googleUrl = 'https://www.google.com/calendar/render?action=TEMPLATE'
                                            . '&text=' . urlencode($entrainement->titre)
                                            . '&dates=' . $start . '/' . $end
                                            . '&details=' . urlencode($entrainement->description)
                                            . '&location=' . urlencode($entrainement->seance->lieu ?? '');
                                    }
                                }
                            @endphp
                            @if($googleUrl)
                                <a href="{{ $googleUrl }}" target="_blank" title="Ajouter à Google Agenda" style="color: #4285F4; font-size: 1.3em;">
                                    <i class="fab fa-google"></i>
                                </a>
                            @elseif($isMyEntrainement)
                                <span style="color: #aaa;">Données séance manquantes</span>
                            @else
                                <span style="color: #aaa;">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @auth
        <div class="action-buttons" style="margin-top: 30px; display: flex; gap: 10px;">
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('entrainements.create') }}">
                    <button class="btn btn-primary">
                        Créer un entraînement
                    </button>
                </a>
            @endif
            <form method="GET" action="{{ route('indisponibilites.create') }}">
                <button type="submit" class="btn btn-violet">
                    Signaler une indisponibilité
                </button>
            </form>
            <form method="GET" action="{{ route('indisponibilites.proposerEchangeForm') }}">
                <button type="submit" class="btn btn-blue-light">
                    Proposer un échange
                </button>
            </form>
            <a href="{{ route('seances.parPeriode') }}" class="btn btn-violet">
                Filtrer par période
            </a>
        </div>
    @endauth

    <!-- Font Awesome pour l'icône Google Agenda -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
@endsection