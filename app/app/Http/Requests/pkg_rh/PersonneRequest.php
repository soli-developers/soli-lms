<?php

namespace App\Http\Requests\pkg_rh;

use Illuminate\Foundation\Http\FormRequest;

class PersonneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required',
            'nom_arab' => 'required',
            'prenom_arab' => 'required',
            'date_naissance' => 'required',
            'tele_num' => 'required',
            'rue' => 'required',
            'ville_id' => 'required',
            'cin' => 'required',
            'groupe_id' => 'required',
            'cne' => 'sometimes',
            'specialite_id' => 'sometimes',
            'niveau_scolaire_id' => 'sometimes',
            'lieu_naissance_id' => 'required',
            '_token' => 'required',
            'email' => 'sometimes',
            'password' => 'sometimes',
        ];
    }
}
