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
}
