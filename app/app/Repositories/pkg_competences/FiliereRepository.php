<?php

namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\Filiere;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\FiliereAlreadyExistException;

/**
 * Class FiliereRepository that manages the persistence of Filiere in the database.
 */
class FiliereRepository extends BaseRepository
{
    /**
     * Searchable fields for Filiere.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'nom',
        'description',
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
        parent::__construct(new Filiere());
    }

    /**
     * Create a new Filiere.
     *
     * @param array $data Filiere data.
     * @return mixed
     * @throws FiliereAlreadyExistException If the Filiere already exists.
     */
    public function create(array $data)
    {
        $nom = $data['nom'];
        $nom = $data['description'];

        $existingFiliere = $this->model->where('nom', $nom)->exists();

        if ($existingFiliere) {
            throw new FiliereAlreadyExistException("Filiere already exists.");
        } else {
            return parent::create($data);
        }
    }

    /**
     * Search Filiere based on specified criteria.
     *
     * @param mixed $searchableData Search data.
     * @param int $perPage Items per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchData($searchableData, $perPage = 4)
    {
        return $this->model->where(function ($query) use ($searchableData) {
            $query->where('nom', 'like', '%' . $searchableData . '%')
                ->orWhere('description', 'like', '%' . $searchableData . '%');
        })->paginate($perPage);
    }
}
