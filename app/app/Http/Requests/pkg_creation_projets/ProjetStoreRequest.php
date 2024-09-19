<?php

namespace App\Http\Requests\pkg_creation_projets;

use Illuminate\Foundation\Http\FormRequest;

class ProjetStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You might want to add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'travailAFaire' => 'required|string',
            'critereDeTravail' => 'required|string',
            'description' => 'required|string',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'livrable.*' => 'required|string|max:255', // Make sure Livrables have a title
            'livrable_description.*' => 'required|string',
            'livrable_link.*' => 'required|url',
            'livrable_nature.*' => 'required|integer|exists:nature_livrables,id',
            'ressource_nom.*' => 'required|string|max:255', // Make sure Resources have a name
            'ressource_description.*' => 'required|string',
            'ressource_lien.*' => 'required|url',
            'competences.*' => 'required|integer|exists:competences,id',
            'competence_*_appreciation' => 'required|integer|exists:appreciations,id',
            // Corrected technology rule
            'technologie_ids.*.*' => 'nullable|integer|exists:technologies,id',
            // Assuming 'personnes' table holds apprenants
            'apprenants.*' => 'required|integer|exists:personnes,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'titre.required' => 'Le titre du projet est obligatoire.',
            'titre.string' => 'Le titre du projet doit être une chaîne de caractères.',
            'titre.max' => 'Le titre du projet ne peut pas dépasser :max caractères.',
            'travailAFaire.required' => 'Le travail à faire est obligatoire.',
            'travailAFaire.string' => 'Le travail à faire doit être une chaîne de caractères.',
            'critereDeTravail.required' => 'Le critère de travail est obligatoire.',
            'critereDeTravail.string' => 'Le critère de travail doit être une chaîne de caractères.',
            'description.required' => 'La description du projet est obligatoire.',
            'description.string' => 'La description du projet doit être une chaîne de caractères.',
            'dateDebut.required' => 'La date de début du projet est obligatoire.',
            'dateDebut.date' => 'La date de début du projet doit être une date valide.',
            'dateFin.required' => 'La date de fin du projet est obligatoire.',
            'dateFin.date' => 'La date de fin du projet doit être une date valide.',
            'dateFin.after_or_equal' => 'La date de fin du projet doit être après ou égale à la date de début.',
            'livrable.*.required' => 'Chaque livrable doit avoir un titre.',
            'livrable.*.string' => 'Le titre du livrable doit être une chaîne de caractères.',
            'livrable.*.max' => 'Le titre du livrable ne peut pas dépasser :max caractères.',
            'livrable_description.*.required' => 'Chaque livrable doit avoir une description.',
            'livrable_description.*.string' => 'La description du livrable doit être une chaîne de caractères.',
            'livrable_link.*.required' => 'Chaque livrable doit avoir un lien.',
            'livrable_link.*.url' => 'Le lien du livrable doit être une URL valide.',
            'livrable_nature.*.required' => 'Chaque livrable doit avoir une nature.',
            'livrable_nature.*.integer' => 'La nature du livrable doit être un nombre entier.',
            'livrable_nature.*.exists' => 'Veuillez sélectionner une nature de livrable valide.',
            'ressource_nom.*.required' => 'Chaque ressource doit avoir un nom.',
            'ressource_nom.*.string' => 'Le nom de la ressource doit être une chaîne de caractères.',
            'ressource_nom.*.max' => 'Le nom de la ressource ne peut pas dépasser :max caractères.',
            'ressource_description.*.required' => 'Chaque ressource doit avoir une description.',
            'ressource_description.*.string' => 'La description de la ressource doit être une chaîne de caractères.',
            'ressource_lien.*.required' => 'Chaque ressource doit avoir un lien.',
            'ressource_lien.*.url' => 'Le lien de la ressource doit être une URL valide.',
            'competences.*.required' => 'Veuillez sélectionner au moins une compétence.',
            'competences.*.integer' => 'La compétence doit être un nombre entier.',
            'competences.*.exists' => 'Veuillez sélectionner une compétence valide.',
            'competence_*_appreciation.required' => 'Veuillez sélectionner une appréciation pour chaque compétence.',
            'competence_*_appreciation.integer' => 'L\'appréciation doit être un nombre entier.',
            'competence_*_appreciation.exists' => 'Veuillez sélectionner une appréciation valide.',
            'technologie_ids.*.*.integer' => 'La technologie doit être un nombre entier.',
            'technologie_ids.*.*.exists' => 'Veuillez sélectionner une technologie valide.',
            'apprenants.*.required' => 'Veuillez sélectionner au moins un apprenant.',
            'apprenants.*.integer' => 'L\'apprenant doit être un nombre entier.',
            'apprenants.*.exists' => 'Veuillez sélectionner un apprenant valide.',
        ];
    }
}
