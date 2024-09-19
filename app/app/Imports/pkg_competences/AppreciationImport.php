<?php

namespace App\Imports\pkg_competences;

use Carbon\Carbon;
use App\Models\pkg_competences\Appreciation;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AppreciationImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Appreciation([
            'nom' => $row["nom"],
            'description' => $row["description"],
            'noteMin' => $row["noteMin"],
            'noteMax' => $row["noteMax"],

        ]);
    }


}
