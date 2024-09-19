<?php

namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\CategorieTechnologie;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\categorietechnologieException;

/**
 * Class CompetenRepository that manages the persistence of Categorie Technologie in the database.
 */
class categorietechnologieRepository extends BaseRepository
{
    /**
     * Searchable fields for Categorie Technologie.
     *
     * @var array
     */
    protected $fieldsSearchable = [

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
     * Categorie Technologie constructor.
     */
    public function __construct()
    {
        parent::__construct(new CategorieTechnologie());
    }

    /**
     * Create a new Categorie Technologie.
     *
     * @param array $data Categorie Technologie data.
     * @return mixed
     * @throws categorietechnologieException If the Categorie Technologie already exists.
     */
    public function create(array $data)
{



    $nom = $data['nom'];
    $description = $data['description'];

    $existingCategorieTechnologie = $this->model->where('nom', $nom)->exists();
    $existingCategorieTechnologie = $this->model->where('description', $description)->exists();

    if ($existingCategorieTechnologie) {
        throw new categorietechnologieException("Categorie Technologie already exists.");
    } else {
        return parent::create($data);
    }
}


    /**
     * Search Categorie Technologie based on specified criteria.
     *
     * @param mixed $searchableData Search data.
     * @param int $perPage Items per page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchData($searchableData, $perPage = 4)
    {
        return $this->model->where(function ($query) use ($searchableData) {
            $query->orWhere('nom', 'like', '%' . $searchableData . '%')
                ->orWhere('description', 'like', '%' . $searchableData . '%');

        })->paginate($perPage);
    }
}
