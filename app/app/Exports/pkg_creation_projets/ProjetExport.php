<?php

namespace App\Exports\pkg_creation_projets;

use App\Models\pkg_creation_projets\Projet;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjetExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Projet::with([
            'livrables',
            'resources',
            'transfertCompetences.competence',
            'transfertCompetences.appreciation',
            'transfertCompetences.technologies',
            'realisationProjets.personne'
        ])->get();
    }

    /**
     * @param Projet $project
     * @return array
     */
    public function map($project): array
    {
        $livrables = $project->livrables->pluck('titre')->implode(', ');
        $resources = $project->resources->pluck('nom')->implode(', ');
        $competences = $project->transfertCompetences->pluck('competence.nom')->implode(', ');
        $appreciations = $project->transfertCompetences->pluck('appreciation.nom')->implode(', ');
        $technologies = $project->transfertCompetences->pluck('technologies.nom')->implode(', ');
        $apprenants = $project->realisationProjets->pluck('personne.nom')->implode(', ');
        $dateDebut = Carbon::parse($project->dateDebut); // Assuming dateDebut is a string
        $dateFin = Carbon::parse($project->dateFin); 
        return [
            'titre' => $project->titre,
            'description' => $project->description,
            'dateDebut' => $dateDebut->format('Y-m-d'),
            'dateFin' => $dateFin->format('Y-m-d'),
            'livrable' => $livrables,
            'ressource_nom' => $resources,
            'competence' => $competences,
            'appreciation' => $appreciations,
            'technologie' => $technologies,
            'apprenant' => $apprenants,
        ];
    }

    public function headings(): array
    {
        return [
            'Titre',
            'Description',
            'Date de début',
            'Date de fin',
            'Livrables',
            'Ressources',
            'Compétences',
            'Appréciations',
            'Technologies',
            'Apprenants',
        ];
    }
}