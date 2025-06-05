<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLPPE_IndisponibilitesRequest;
use App\Http\Requests\UpdateLPPE_IndisponibilitesRequest;
use App\Models\LPPE_Indisponibilites;
use Illuminate\Http\Request;

class LPPEIndisponibilitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupère les entraînements où l'utilisateur est responsable
        $entrainements = \App\Models\LPPE_Entrainement::where('id_entraineur', auth()->user()->id_entraineur)->get();
        return view('indisponibilites.create', compact('entrainements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_entrainement' => 'required|exists:l_p_p_e__entrainements,id_entrainement',
            'motif' => 'required|string',
        ]);

        $entrainement = \App\Models\LPPE_Entrainement::findOrFail($request->id_entrainement);

        \App\Models\LPPE_Indisponibilites::create([
            'id_entrainement' => $request->id_entrainement,
            'id_entraineur' => auth()->user()->id_entraineur,
            'motif' => $request->motif,
            'statut' => 'en attente',
            'id_seance' => $entrainement->id_seance,
        ]);

        return redirect()->route('entrainements.index')->with('success', 'Indisponibilité signalée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LPPE_Indisponibilites $lPPE_Indisponibilites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LPPE_Indisponibilites $lPPE_Indisponibilites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLPPE_IndisponibilitesRequest $request, LPPE_Indisponibilites $lPPE_Indisponibilites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LPPE_Indisponibilites $lPPE_Indisponibilites)
    {
        //
    }
    public function adminIndex()
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès réservé à l\'administrateur.');
        }

        $indisponibilites = \App\Models\LPPE_Indisponibilites::with(['entraineur', 'remplacant' , 'entrainement', 'seance'])->get();
        return view('indisponibilites.admin_index', compact('indisponibilites'));
    }

    public function adminUpdate(Request $request, $id)
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès réservé à l\'administrateur.');
        }

        $indispo = \App\Models\LPPE_Indisponibilites::findOrFail($id);
        $ancienStatut = $indispo->statut;
        $indispo->statut = $request->statut;

        if ($request->statut === 'refusée') {
            $indispo->statut = 'en attente';
            $indispo->id_entraineur_remplacant = null;
        }

        $indispo->save();

        if ($request->statut === 'validée' && $indispo->id_entraineur_remplacant) {
            // Séance de l'indisponibilité
            $seanceA = $indispo->seance;
            $entraineurA = $seanceA->id_entraineur;
            $entraineurB = $indispo->id_entraineur_remplacant;

            // Trouver une séance du remplaçant (hors celle déjà concernée)
            $seanceB = \App\Models\LPPE_Seances::where('id_entraineur', $entraineurB)
                ->where('id_seance', '!=', $seanceA->id_seance)
                ->orderBy('date_seance', 'asc')
                ->first();

            if ($seanceB) {
                // Échanger les entraîneurs dans les séances
                $seanceA->id_entraineur = $entraineurB;
                $seanceA->save();

                $seanceB->id_entraineur = $entraineurA;
                $seanceB->save();

                // Échanger aussi dans les entraînements liés
                $entrainementA = $seanceA->entrainement;
                $entrainementB = $seanceB->entrainement;

                // Si l'entraînement n'existe pas, on le crée
                if (!$entrainementA) {
                    $entrainementA = new \App\Models\LPPE_Entrainement();
                    $entrainementA->id_seance = $seanceA->id_seance;
                    $entrainementA->id_entraineur = $entraineurB;
                    $entrainementA->titre = 'Entraînement généré'; // adapte si besoin
                    $entrainementA->save();
                } else {
                    $entrainementA->id_entraineur = $entraineurB;
                    $entrainementA->save();
                }

                if (!$entrainementB) {
                    $entrainementB = new \App\Models\LPPE_Entrainement();
                    $entrainementB->id_seance = $seanceB->id_seance;
                    $entrainementB->id_entraineur = $entraineurA;
                    $entrainementB->titre = 'Entraînement généré'; // adapte si besoin
                    $entrainementB->save();
                } else {
                    $entrainementB->id_entraineur = $entraineurA;
                    $entrainementB->save();
                }

                $message = 'Échange réciproque effectué entre les deux entraîneurs.';
            } else {
                // Pas de séance à échanger pour le remplaçant
                $seanceA->id_entraineur = $entraineurB;
                $seanceA->save();

                $entrainementA = $seanceA->entrainement;
                if (!$entrainementA) {
                    $entrainementA = new \App\Models\LPPE_Entrainement();
                    $entrainementA->id_seance = $seanceA->id_seance;
                    $entrainementA->id_entraineur = $entraineurB;
                    $entrainementA->titre = 'Entraînement généré'; // adapte si besoin
                    $entrainementA->save();
                } else {
                    $entrainementA->id_entraineur = $entraineurB;
                    $entrainementA->save();
                }
                $message = 'Aucune séance trouvée pour le remplaçant à échanger. Seule la séance initiale a été modifiée.';
            }
        } else {
            $message = 'Indisponibilité mise à jour.';
        }

        return redirect()->route('admin.indisponibilites.index')->with('success', $message);
    }
    public function proposerEchangeForm()
    {
        $indispos = \App\Models\LPPE_Indisponibilites::whereIn('statut', ['en attente', 'validée'])
            ->with(['entraineur', 'seance.entrainement'])
            ->get();

        return view('indisponibilites.proposer_echange', compact('indispos'));
    }

    public function proposerEchange($id)
    {
        $indispo = \App\Models\LPPE_Indisponibilites::findOrFail($id);

        // On n'enregistre que si aucun remplaçant n'est déjà proposé
        if (is_null($indispo->id_entraineur_remplacant)) {
            $indispo->id_entraineur_remplacant = auth()->user()->id_entraineur;
            $indispo->save();
            return redirect()->back()->with('success', 'Votre proposition d\'échange a été prise en compte.');
        } else {
            return redirect()->back()->with('error', 'Un remplaçant a déjà été proposé pour cette indisponibilité.');
        }
    }

        public function adminValider($id)
    {
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès réservé à l\'administrateur.');
        }

        $indispo = \App\Models\LPPE_Indisponibilites::findOrFail($id);
        $indispo->statut = 'validée';
        $indispo->save();

        return redirect()->route('admin.indisponibilites.index')->with('success', 'L\'échange a été validé.');
    }
}
