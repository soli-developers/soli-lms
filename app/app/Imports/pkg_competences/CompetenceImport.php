<?php

namespace App\Imports\pkg_competences;

use Carbon\Carbon;
use App\Models\pkg_competences\Competence;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompetenceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Competence([
            'code' => $row["code"],
            'nom' => $row["nom"],
            'description' => $row["description"],

        ]);
    }


}
