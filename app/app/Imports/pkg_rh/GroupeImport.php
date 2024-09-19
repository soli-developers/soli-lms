<?php

namespace App\Imports\pkg_rh;

use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Groupe;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupeImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Groupe([
            'nom' => $row["nom"],
        ]);
    }
}
