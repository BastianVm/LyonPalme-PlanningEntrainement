<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Indisponibilites extends Model
{
    /** @use HasFactory<\Database\Factories\LPPEIndisponibilitesFactory> **/
    use HasFactory;
    protected $primaryKey = 'id_indispo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'motif',
        'statut',
        'id_entraineur',
        'id_seance',
        'id_entraineur_remplacant',
    ];

    public function entraineur()
    {
        return $this->belongsTo(\App\Models\LPPE_Entraineurs::class, 'id_entraineur', 'id_entraineur');
    }

    public function entrainement()
    {
        return $this->belongsTo(\App\Models\LPPE_Entrainement::class, 'id_entrainement', 'id_entrainement');
    }

    public function seance()
    {
        return $this->belongsTo(\App\Models\LPPE_Seances::class, 'id_seance', 'id_seance');
    }

    public function entrainementViaSeance()
    {
        return $this->hasOne(\App\Models\LPPE_Entrainement::class, 'id_seance', 'id_seance');
    }

    public function remplacant()
    {
        return $this->belongsTo(\App\Models\LPPE_Entraineurs::class, 'id_entraineur_remplacant', 'id_entraineur');
    }
}
