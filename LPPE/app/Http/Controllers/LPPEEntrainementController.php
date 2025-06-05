<?php

namespace App\Http\Controllers;

use App\Models\LPPE_Entrainement;
use App\Models\LPPE_Seances;
use App\Models\LPPE_Entraineurs;
use Illuminate\Http\Request;

class LPPEEntrainementController extends Controller
{
    public function index()
    {
        $entrainements = \App\Models\LPPE_Entrainement::with(['seance', 'entraineur'])->get();
        return view('entrainements.index', compact('entrainements'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Seuls les admins peuvent créer un entraînement.');
        }
        $seances = LPPE_Seances::all();
        $entraineurs = LPPE_Entraineurs::all();
        return view('entrainements.create', compact('seances', 'entraineurs'));
    }

    // Enregistre un nouvel entrainement
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Seuls les admins peuvent créer un entraînement.');
        }
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_seance' => 'required|exists:l_p_p_e__seances,id_seance',
            'id_entraineur' => 'required|exists:l_p_p_e__entraineurs,id_entraineur',
        ]);

        LPPE_Entrainement::create($request->all());

        return redirect()->route('entrainements.create')->with('success', 'Entrainement créé !');
    }
}