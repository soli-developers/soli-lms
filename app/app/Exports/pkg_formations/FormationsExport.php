<?php
namespace App\Exports\pkg_formations;

use App\Models\pkg_formations\Formation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormationsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Formation::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nom',
            'Description',
            'Lien',
            'created_at',
            'updated_at'
        ];
    }
}
