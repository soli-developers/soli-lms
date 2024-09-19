<?php

namespace App\Imports\pkg_rh;

use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Ville;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VilleImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        return new Ville([
            'nom' => $row["nom"],
        ]);
    }
}
