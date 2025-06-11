<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLPPE_SeancesRequest;
use App\Http\Requests\UpdateLPPE_SeancesRequest;
use App\Models\LPPE_Seances;
use Illuminate\Http\Request;

class LPPESeancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seances = \App\Models\LPPE_Seances::with('entraineur')->get();

        // Récupère les id déjà utilisés
        $usedIds = \App\Models\LPPE_Seances::pluck('id_seance')->toArray();

        // Propose les id de 1 à 100 qui ne sont pas utilisés
        $availableIds = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!in_array($i, $usedIds)) {
                $availableIds[] = $i;
            }
        }

        // Récupère les entraîneurs pour le select
        $entraineurs = \App\Models\User::whereHas('entraineur')->get();

        return view('planning.index', compact('seances', 'availableIds', 'entraineurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLPPE_SeancesRequest $request)
    {
        $request->validate([
            'id_seance'     => 'required|unique:l_p_p_e__seances,id_seance',
            'date_seance'   => 'required|date',
            'heure_debut'   => 'required|date_format:H:i',
            'heure_fin'     => 'required|date_format:H:i',
            'id_entraineur' => 'required|integer|exists:users,id',
        ]);

        \App\Models\LPPE_Seances::create($request->all());

        return redirect()->route('planning.index')->with('success', 'Séance créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LPPE_Seances $lPPE_Seances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LPPE_Seances $seance)
    {
        $user = auth()->user();
        if (
            !$user ||
            !$user->entraineur ||
            strtolower(trim($user->entraineur->rôle)) !== 'admin'
        ) {
            abort(403, 'Accès réservé aux admins');
        }

        // Récupère tous les entraîneurs pour le select
        $entraineurs = \App\Models\User::whereHas('entraineur')->get();

        return view('seances.edit', ['seance' => $seance, 'entraineurs' => $entraineurs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLPPE_SeancesRequest $request, LPPE_Seances $seance)
    {
        $user = auth()->user();
        if (!$user || !$user->hasRole('admin')) {
           abort(403, 'Accès réservé aux admins');
        }

        $validated = $request->validate([
            'date_seance'   => 'required|date',
            'heure_debut'   => 'required|date_format:H:i',
            'heure_fin'     => 'required|date_format:H:i',
            'id_entraineur' => 'required|integer|exists:users,id',
        ]);

        $seance->update($validated);

        return redirect()->route('planning.index')->with('success', 'Séance modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LPPE_Seances $seance)
    {
        $user = auth()->user();
        if (
            !$user ||
            !$user->entraineur ||
            strtolower(trim($user->entraineur->rôle)) !== 'admin'
        ) {
            abort(403, 'Accès réservé aux admins');
        } 

        $seance->delete();

        return redirect()->route('planning.index')->with('success', 'Séance supprimée avec succès.');
    }

    public function updateDirect(Request $request, $id)
    {
        $seance = \App\Models\LPPE_Seances::findOrFail($id);

        $validated = $request->validate([
            'date_seance'   => 'required|date',
            'heure_debut'   => 'required|date_format:H:i',
            'heure_fin'     => 'required|date_format:H:i',
            'id_entraineur' => 'required|integer|exists:users,id',
        ]);

        $seance->update($validated);

        return redirect()->route('seances.index')->with('success', 'Séance modifiée !');
    }

    public function parPeriode(Request $request)
    {
        $debut = $request->input('debut');
        $fin = $request->input('fin');
        $seances = null;

        if ($debut && $fin) {
            $seances = \App\Models\LPPE_Seances::whereBetween('date_seance', [$debut, $fin])->get();
        }

        return view('seances.par_periode', compact('seances', 'debut', 'fin'));
    }
}