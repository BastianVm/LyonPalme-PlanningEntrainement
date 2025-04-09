<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Indisponibilites extends Model
{
    /** @use HasFactory<\Database\Factories\LPPEIndisponibilitesFactory> **/
    use HasFactory;
    protected $fillable = [
        'id_indispo',
        'motif',
        'statut',
        'id_entraineur',
        'id_seance',
        'id_entraineur_remplacant',
    ];
}
