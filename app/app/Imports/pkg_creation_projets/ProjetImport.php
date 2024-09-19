<?php

namespace App\Imports\pkg_creation_projets;

use App\Models\pkg_creation_projets\Projet;
use App\Models\pkg_creation_projets\Livrable;
use App\Models\pkg_creation_projets\Resource;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_competences\Appreciation;
use App\Models\pkg_competences\Technologie;
use App\Models\pkg_rh\Personne;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\Importable;

class ProjetImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Assuming your Excel file has these headers:
        // - titre
        // - description
        // - dateDebut
        // - dateFin
        // - livrable (comma-separated list of livrables)
        // - ressource_nom (comma-separated list of resources)
        // - competence (comma-separated list of competences)
        // - appreciation (comma-separated list of appreciations)
        // - technologie (comma-separated list of technologies)
        // - apprenant (comma-separated list of apprenant names)

        // Find or create the associated models
        $competence = Competence::firstOrCreate(['nom' => $row['competence']]);
        $appreciation = Appreciation::firstOrCreate(['nom' => $row['appreciation']]);

        // Create the project
        $project = new Projet([
            'titre' => $row['titre'],
            'description' => $row['description'],
            'dateDebut' => Carbon::createFromFormat('Y-m-d', $row['dateDebut']),
            'dateFin' => Carbon::createFromFormat('Y-m-d', $row['dateFin']),
        ]);
        $project->save();

        // Create livrables
        $livrables = explode(',', $row['livrable']);
        foreach ($livrables as $livrableName) {
            $livrable = new Livrable([
                'titre' => trim($livrableName),
                'projet_id' => $project->id,
            ]);
            $livrable->save();
        }

        // Create resources
        $resources = explode(',', $row['ressource_nom']);
        foreach ($resources as $resourceName) {
            $resource = new Resource([
                'nom' => trim($resourceName),
                'projet_id' => $project->id,
            ]);
            $resource->save();
        }

        // Create TransfertCompetence records
        $project->transfertCompetences()->create([
            'competence_id' => $competence->id,
            'appreciation_id' => $appreciation->id,
        ]);

        // Associate technologies with TransfertCompetence
        $technologies = explode(',', $row['technologie']);
        foreach ($technologies as $technologieName) {
            $technologie = Technologie::firstOrCreate(['nom' => trim($technologieName)]);
            $project->transfertCompetences->first()->technologies()->attach($technologie->id);
        }

        // Associate apprentices
        $apprenants = explode(',', $row['apprenant']);
        foreach ($apprenants as $apprenantName) {
            $apprenant = Personne::where('nom', trim($apprenantName))->first();
            if ($apprenant) {
                $project->realisationProjets()->create([
                    'personne_id' => $apprenant->id,
                ]);
            }
        }

        return $project;
    }

    public function batchSize(): int
    {
        return 1000; // Adjust based on your server's capacity
    }
}