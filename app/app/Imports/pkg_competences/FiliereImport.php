<?php

namespace App\Imports\pkg_competences;

use Carbon\Carbon;
use App\Models\pkg_competences\Filiere;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FiliereImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Filiere([
            'nom' => $row["nom"],
            'description' => $row["description"],

        ]);
    }


}
