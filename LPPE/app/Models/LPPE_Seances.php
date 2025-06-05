<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Seances extends Model
{
    /** @use HasFactory<\Database\Factories\LPPESeancesFactory> **/
    use HasFactory;
    protected $table = 'l_p_p_e__seances';
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

     public function entraineur()
    {
        return $this->belongsTo(User::class, 'id_entraineur');
    }

    public function getRouteKeyName()
    {
        return 'id_seance';
    }

    public function entrainement()
    {
        return $this->hasOne(\App\Models\LPPE_Entrainement::class, 'id_seance', 'id_seance');
    }
}
