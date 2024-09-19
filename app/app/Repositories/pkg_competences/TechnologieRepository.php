<?php

namespace App\Repositories\Pkg_competences;

use App\Repositories\BaseRepository;
use App\Models\pkg_competences\Technologie;
use App\Exceptions\pkg_competences\TechnologieAlreadyExistException;

class TechnologieRepository extends BaseRepository
{
    protected $fieldsSearchable = [
        'nom',
        'description',
        'categorie_technologies_id',
        'competence_id',
    ];

    /**
     * Renvoie les champs de recherche disponibles.
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldsSearchable;
    }

    /**
     * Constructeur de la classe TechnologieRepository.
     */
    public function __construct()
    {
        parent::__construct(new Technologie());
    }

    /**
     * Crée un nouveau Technologie.
     *
     * @param array $data Données du Technologie à créer.
     * @return mixed
     * @throws TechnologieAlreadyExistException Si le Technologie existe déjà.
     */
    public function create(array $data)
    {
        $nom = $data['nom'];
        $description = $data['description'];

        $existingProject = $this->model->where('nom', $nom)->exists();
        $existingProject = $this->model->where('description', $description)->exists();

        if ($existingProject) {
            throw TechnologieAlreadyExistException::createTechnologie();
        } else {
            return parent::create($data);
        }
    }

    /**
     * Recherche les Technologies correspondants aux critères spécifiés.
     *
     * @param mixed $searchableData Données de recherche.
     * @param int $perPage Nombre d'éléments par page.
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
