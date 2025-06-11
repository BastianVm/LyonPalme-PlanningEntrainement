<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LPPE_Seances;
use App\Models\User;

class PlanningController extends Controller
{
    public function index()
    {
        $seances = LPPE_Seances::with('entraineur')->get();

        // Récupère les id déjà utilisés
        $usedIds = LPPE_Seances::pluck('id_seance')->toArray();

        // Propose les id de 1 à 100 qui ne sont pas utilisés
        $availableIds = [];
        for ($i = 1; $i <= 100; $i++) {
            if (!in_array($i, $usedIds)) {
                $availableIds[] = $i;
            }
        }

        // Récupère les entraîneurs pour le select
        $entraineurs = User::whereHas('entraineur')->get();

        return view('planning.index', compact('seances', 'availableIds', 'entraineurs'));
    }
}