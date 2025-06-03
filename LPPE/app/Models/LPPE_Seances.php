<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Seances extends Model
{
    /** @use HasFactory<\Database\Factories\LPPESeancesFactory> **/
    use HasFactory;
    protected $primaryKey = 'id_seance';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'date_seance',
        'heure_debut',
        'heure_fin',
        'id_planning',
        'id_entraineur',
    ];
}
