<?php

namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\Module;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\ModuleAlreadyExistException;

/**
 * Class ModuleRepository that manages the persistence of Module in the database.
 */
class ModuleRepository extends BaseRepository
{
    /**
     * Searchable fields for Module.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'N',
        'nom',
        'description',
        'filiere_id',
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
     * ModuleRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new Module());
    }

    /**
     * Create a new Module.
     *
     * @param array $data Competence data.
     * @return mixed
     * @throws ModuleAlreadyExistException If the Module already exists.
     */
    public function create(array $data)
    {
        $nom = $data['nom'];

        $existingModule = $this->model->where('nom', $nom)->exists();

        if ($existingModule) {
            throw new ModuleAlreadyExistException("Module already exists.");
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
            $query->where('nom', 'like', '%' . $searchableData . '%')
                ->orWhere('description', 'like', '%' . $searchableData . '%');
        })->paginate($perPage);
    }
}
