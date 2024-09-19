<?php

namespace App\Models\pkg_rh;

use App\Models\pkg_creation_projets\Projet;
use App\Models\pkg_rh\Personne;
use App\Models\User;
use App\Traits\MorphType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Personne
{
    protected $table = 'personnes';
    use HasFactory, MorphType;
    protected $fillable = [
        'nom',
        'prenom',
        'nom_arab',
        'prenom_arab',
        'profile_image',
        'date_naissance',
        'tele_num',
        'rue',
        'ville_id',
        'user_id',
        'cin',
        'groupe_id',
        'specialite_id',
        'lieu_naissance_id',
        '_token'
    ];
    public function specialite(){
        return $this->belongsTo(Specialite::class);
    }

    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }

    public function Ville(){
        return $this->belongsTo(Ville::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function projets()
    {
        return $this->hasMany(Projet::class, 'formateur_id');
    }
}
