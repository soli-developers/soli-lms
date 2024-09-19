<?php

namespace App\Models\pkg_creation_projets;

use App\Models\pkg_competences\Appreciation;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_competences\Technologie;
use App\Models\pkg_validations\Validation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransfertCompetence extends Model
{
    use HasFactory;
    protected $fillable = [
        'projet_id', 'competence_id', 'appreciation_id'
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }

    public function appreciation()
    {
        return $this->belongsTo(Appreciation::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technologie::class, 'technologie_competences', 'transfert_competence_id', 'technologie_id');
    }

    public function validations()
    {
        return $this->hasMany(Validation::class);
    }
}
