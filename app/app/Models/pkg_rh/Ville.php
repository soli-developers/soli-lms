<?php

namespace App\Models\pkg_rh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    public function Apprenant(){
        return $this->belongsTo(Apprenant::class);
    }

    protected $fillable = ['nom'];
}
