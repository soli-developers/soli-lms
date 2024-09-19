<?php

namespace App\Models\GestionRH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\GestionRH\Apprenant;

class NiveauScolaire extends Model
{
    use HasFactory;
    protected $table = 'niveau_scolaire';

    public function Apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }
}
