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
        $seances = LPPE_Seances::with('entraineur')->get();
        return view('planning.index', compact('seances'));
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
        //
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
        return view('seances.edit', ['seance' => $seance]);
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
            'heure_debut'   => 'required|date_format:H:i:s',
            'heure_fin'     => 'required|date_format:H:i:s',
            'id_planning'   => 'required|integer',
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
            'heure_debut'   => 'required|date_format:H:i:s',
            'heure_fin'     => 'required|date_format:H:i:s',
            'id_planning'   => 'required|integer',
        ]);

        $seance->update($validated);

        return redirect()->route('seances.index')->with('success', 'Séance modifiée !');
    }
}
