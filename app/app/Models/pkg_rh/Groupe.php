<?php

namespace App\Models\pkg_rh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    public function Formateur(){
        return $this->hasMany(Formateur::class);
    }

    public function Apprenant(){
        return $this->hasMany(Apprenant::class);
    }

    protected $fillable = ['nom', 'description'];
}
