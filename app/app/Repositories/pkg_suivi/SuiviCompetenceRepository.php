<?php

namespace App\Repositories\pkg_suivi;

use App\Models\pkg_rh\Personne;
use App\Repositories\BaseRepository;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_validations\Validation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class SuiviCompetenceRepository extends BaseRepository
{
    protected $fieldsSearchable = [
        'nom'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldsSearchable;
    }

    public function __construct()
    {
        parent::__construct(new Validation()); // Adjust the model as per your need
    }

    public function getApprenantsCompetences($personneId)
    {
        // Fetch user's group ID
        $userGroupId = Personne::where('id', $personneId)->value('groupe_id');
    
        // Fetch all competences
        $competences = Competence::all();
    
        // Fetch apprenants in the same group
        $apprenantsPaginator = $this->paginate(['groupe_id' => $userGroupId, 'type' => 'apprenant']);
        $apprenants = $apprenantsPaginator->items();
    
        // Fetch validations for apprenants and competences
        $validations = Validation::whereHas('realisationProjet.personne', function($query) use ($userGroupId) {
                $query->where('groupe_id', $userGroupId);
            })
            ->with(['transfertCompetence.competence', 'appreciation', 'realisationProjet.personne'])
            ->paginate($this->paginationLimit); // Paginate the validations
    
        // Prepare results array
        $results = $this->prepareResults($apprenants, $competences, $validations);
    
        // Create paginated results array
        $paginatedResults = new LengthAwarePaginator(
            $results,
            $apprenantsPaginator->total(),
            $apprenantsPaginator->perPage(),
            $apprenantsPaginator->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return [
            'results' => $paginatedResults, 
            'competences' => $competences, 
            'validations' => $validations // Pass the paginated validations to the view
        ];
    }

    protected function prepareResults($apprenants, $competences, $validations)
    {
        $results = [];

        foreach ($apprenants as $apprenant) {
            $apprenantResults = [
                'name' => $apprenant->nom . ' ' . $apprenant->prenom
            ];

            foreach ($competences as $competence) {
                $highestAppreciation = $validations->first(function ($validation) use ($apprenant, $competence) {
                    return $validation->realisationProjet->personne->id == $apprenant->id &&
                           $validation->transfertCompetence->competence->id == $competence->id;
                });

                $apprenantResults[$competence->nom] = $highestAppreciation
                    ? $highestAppreciation->appreciation->nom
                    : 'Aucune';
            }

            $results[] = $apprenantResults;
        }

        return $results;
    }

    public function paginate($search = [], $perPage = 0, array $columns = ['*']): LengthAwarePaginator
    {
        if ($perPage == 0) {
            $perPage = $this->paginationLimit;
        }

        $query = Personne::query();

        foreach ($search as $key => $value) {
            $query->where($key, $value);
        }

        return $query->paginate($perPage, $columns);
    }
}
