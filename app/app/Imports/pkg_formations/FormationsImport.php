<?php

namespace App\Imports\pkg_formations;

use App\Models\pkg_formations\Formation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Date;

class FormationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Formation|null
    */
    public function model(array $row)
    {
        return new Formation([
            'nom' => $row['Nom'],
            'description' => $row['Description'],
            'lien' => $row['Lien'],
            'created_at' => Date::createFromFormat('Y-m-d H:i:s', $row['created_at']),
            'updated_at' => Date::createFromFormat('Y-m-d H:i:s', $row['updated_at']),
        ]);
    }
}