<?php

namespace App\Imports\pkg_competences;

use Carbon\Carbon;
use App\Models\pkg_competences\Module;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ModuleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new Module([
            'N' => $row["N"],
            'nom' => $row["nom"],
            'description' => $row["description"],
            'filiere_id' => $row["filiere_id"],

        ]);
    }


}
