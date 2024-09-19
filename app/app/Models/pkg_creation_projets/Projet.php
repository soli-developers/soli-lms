<?php

namespace App\Models\pkg_creation_projets;

use App\Models\pkg_competences\Competence;
use App\Models\pkg_realisation_projets\RealisationProjet;
use App\Models\pkg_rh\Formateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'travailAFaire', 'critereDeTravail', 'description', 'dateDebut', 'dateFin','formateur_id'
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function livrables()
    {
        return $this->hasMany(Livrable::class);
    }

    public function transfertCompetences()
    {
        return $this->hasMany(TransfertCompetence::class);
    }

    public function realisationProjets()
    {
        return $this->hasMany(RealisationProjet::class);
    }
    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'transfert_competences');
    }
    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }
}
