<?php

namespace App\Imports\pkg_competences;

use Carbon\Carbon;
use App\Models\pkg_competences\NiveauCompetence;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NiveauCompetenceImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new NiveauCompetence([
            'nom' => $row["nom"],
            'description' => $row["description"],
            'competence_id' => $row["competence_id"],

        ]);
    }


}
