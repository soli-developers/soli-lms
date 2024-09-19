<?php

namespace App\Http\Requests\pkg_validations;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
            'realisation_projet_id' => 'required|integer|exists:realisation_projets,id',
            'validations.*.appreciation_id' => 'required|integer|exists:appreciations,id',
            'validations.*.note' => 'required',
            'validations.*.titre' => 'required|string|max:255', 
            'validations.*.description' => 'required|string', 
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'realisation_projet_id.required' => 'Le champ "Réalisations du projet" est obligatoire.',
            'realisation_projet_id.integer' => 'Le champ "Réalisations du projet" doit être un nombre entier.',
            'realisation_projet_id.exists' => 'La "Réalisation du projet" sélectionnée n\'existe pas.',
            'validations.*.appreciation_id.required' => 'Le champ "Appréciation" est obligatoire.',
            'validations.*.appreciation_id.integer' => 'Le champ "Appréciation" doit être un nombre entier.',
            'validations.*.appreciation_id.exists' => 'L\'appréciation sélectionnée n\'existe pas.',
            'validations.*.note.required' => 'Le champ "Note" est obligatoire.',
            'validations.*.titre.required' => 'Le champ "Titre" est obligatoire.',
            'validations.*.titre.string' => 'Le champ "Titre" doit être une chaîne de caractères.',
            'validations.*.titre.max' => 'Le champ "Titre" ne peut pas dépasser 255 caractères.',
            'validations.*.description.required' => 'Le champ "Description" est obligatoire.',
            'validations.*.description.string' => 'Le champ "Description" doit être une chaîne de caractères.',
        ];
    }
}