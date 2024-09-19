<?php

namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\Competence;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\CompetenceAlreadyExistException;

/**
 * Class CompetenRepository that manages the persistence of competences in the database.
 */
class CompetenceRepository extends BaseRepository
{
    /**
     * Searchable fields for competences.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'code',
        'name',
        'description'
    ];

    /**
     * Get searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldsSearchable;
    }

    /**
     * CompetenceRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Competence());
    }

    /**
     * Create a new competence.
     *
     * @param array $data Competence data.
     * @return mixed
     * @throws CompetenceAlreadyExistException If the competence already exists.
     */
    public function create(array $data)
{


    $code = $data['code'] ++  ;
    
    $nom = $data['nom'];
    $description = $data['description'];

    $existingCompetence = $this->model->where('code', $code)->exists();
    $existingCompetence = $this->model->where('nom', $nom)->exists();
    $existingCompetence = $this->model->where('description', $description)->exists();

    if ($existingCompetence) {
        throw new CompetenceAlreadyExistException("Competence already exists.");
    } else {
        return parent::create($data);
    }
}


    /**
     * Search competences based on specified criteria.
     *
     * @param mixed $searchableData Search data.
     * @param int $perPage Items per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchData($searchableData, $perPage = 4)
    {
        return $this->model->where(function ($query) use ($searchableData) {
            $query->where('code', 'like', '%' . $searchableData . '%')
                ->orWhere('nom', 'like', '%' . $searchableData . '%')
                ->orWhere('description', 'like', '%' . $searchableData . '%');

        })->paginate($perPage);
    }
}
