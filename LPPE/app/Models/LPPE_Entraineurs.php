<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Entraineurs extends Model
{
    /** @use HasFactory<\Database\Factories\LPPEEntraineursFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'identifiant',
        'mdp',
        'role'
    ];
}
