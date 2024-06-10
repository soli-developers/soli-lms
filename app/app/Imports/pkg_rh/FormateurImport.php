<?php

namespace App\Imports\pkg_rh;

use App\Exceptions\pkg_rh\FormateurException;
use App\Models\pkg_rh\Formateur;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class FormateurImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        $existingFormateur = Formateur::where('nom', $row["nom"])->where('prenom', $row["prenom"])->exists();
        if ($existingFormateur) {
            throw FormateurException::AlreadyExistFormateur();
        }else{
            $user = new User([
                'email' => $row["nom"] . '2@solicode.co',
                'password' => Hash::make($row["nom"]),
            ]);
            $user->save();
            
            return new Formateur([
                'nom' => $row["nom"],
                'prenom' => $row["prenom"],
                'nom_arab' => $row["nom_arab"],
                'prenom_arab' => $row["prenom_arab"],
                'date_naissance' => $row["date_naissance"],
                'tele_num' => $row["tele_num"],
                'rue' => $row["rue"],
                'ville_id' => $row["ville_id"],
                'cin' => $row["cin"],
                'groupe_id' => $row["groupe_id"],
                'cne' => $row["cne"],
                'specialite_id' => $row["specialite_id"],
                'niveau_scolaire_id' => $row["niveau_scolaire_id"],
                'lieu_naissance_id' => $row["lieu_naissance_id"],
                '_token' => 'fhskjfhsdkjfhskldjfhsdkfhoise',
                'user_id' => $user->id,
            ]);
            }

    }
}
