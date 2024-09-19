<?php

namespace App\Models\pkg_rh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    public function formateur(){
        return $this->hasMany(Formateur::class);
    }

    protected $fillable = ['nom'];

}
