<?php

namespace App\Exports\pkg_rh;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ApprenantExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'nom',
            'prenom',
            'nom_arab',
            'prenom_arab',
            'date_naissance',
            'tele_num',
            'rue',
            'ville_id',
            'cin',
            'groupe_id',
            'cne',
            'specialite_id',
            'niveau_scolaire_id',
            'lieu_naissance_id',
            'email',
            'password',
        ];
    }

    public function collection()
    {
        return $this->data->map(function ($Formateur) {
            return [
                'nom' => $Formateur->nom, 
                'prenom' => $Formateur->prenom,
                'nom_arab' => $Formateur->nom_arab,
                'prenom_arab' => $Formateur->prenom_arab,
                'date_naissance' => $Formateur->date_naissance,
                'tele_num' => $Formateur->tele_num,
                'rue' => $Formateur->rue,
                'ville_id' => $Formateur->ville_id,
                'cin' => $Formateur->cin,
                'groupe_id' => $Formateur->groupe_id,
                'cne' => $Formateur->cne,
                'specialite_id' => $Formateur->specialite_id,
                'niveau_scolaire_id' => $Formateur->niveau_scolaire_id,
                'lieu_naissance_id' => $Formateur->lieu_naissance_id,
                'email' => $Formateur->email,
                'password' => $Formateur->password,
            ];
        });
    }



    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:E{$lastRow}")->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFFF',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle("A1:E1")->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFD3D3D3',
                ],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}