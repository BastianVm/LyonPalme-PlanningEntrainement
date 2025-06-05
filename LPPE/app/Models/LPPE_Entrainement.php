<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPPE_Entrainement extends Model
{
    use HasFactory;

    protected $table = 'l_p_p_e__entrainements';
    protected $primaryKey = 'id_entrainement';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titre',
        'description',
        'id_seance',
        'id_entraineur',
    ];

    // Relations
    public function seance()
    {
        return $this->belongsTo(LPPE_Seances::class, 'id_seance', 'id_seance');
    }

    public function entraineur()
    {
        return $this->belongsTo(LPPE_Entraineurs::class, 'id_entraineur', 'id_entraineur');
    }
}