<?php

namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\Appreciation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\AppreciationAlreadyExistException;

/**
 * Class AppreciationRepository that manages the persistence of Appreciation in the database.
 */
class AppreciationRepository extends BaseRepository
{
    /**
     * Searchable fields for Appreciation.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'nom',
        'description',
        'noteMin',
        'noteMax'
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
        parent::__construct(new Appreciation());
    }

    /**
     * Create a new Appreciation.
     *
     * @param array $data Appreciation data.
     * @return mixed
     * @throws AppreciationAlreadyExistException If the Appreciation already exists.
     */
    public function create(array $data)
    {
        $nom = $data['nom'];
        $nom = $data['description'];
        $noteMin = $data['noteMin'];
        $noteMax = $data['noteMax'];

        $existingFiliere = $this->model->where('nom', $nom)->exists();

        if ($existingFiliere) {
            throw new AppreciationAlreadyExistException("Appreciation already exists.");
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
