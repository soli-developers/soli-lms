<?php

namespace App\Models\pkg_competences;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'nom', 'description'
    ];

    public function niveauxCompetence()
    {
        return $this->hasMany(NiveauCompetence::class, 'competence_id');
    }

    public function technologies()
    {
        return $this->hasMany(Technologie::class,'technologie_competences');
    }
}
