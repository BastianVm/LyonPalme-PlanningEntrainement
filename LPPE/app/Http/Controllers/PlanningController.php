<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LPPE_Seances;

class PlanningController extends Controller
{
    public function index()
    {
        $seances = LPPE_Seances::with('entraineur')->get();
        return view('planning.index', compact('seances'));
    }
    
}
