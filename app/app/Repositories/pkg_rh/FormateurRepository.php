<?php

namespace App\Repositories\pkg_rh;

use App\Models\pkg_rh\Formateur;
use App\Repositories\BaseRepository;
use App\Exceptions\pkg_rh\FormateurException;
use App\Exceptions\pkg_rh\FormateurAlreadyExistException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class FormateurRepository extends BaseRepository
{
    protected $type;

    /**
     * Les champs de recherche disponibles pour les projets.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'nom','prenom','type' ,'groupe_id'
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
     * Constructeur de la classe ProjetRepository.
     */
    public function __construct()
    {
        $this->type = "formateur";
        parent::__construct(new Formateur());
    }

    public function create(array $data)
    {
        $nom = $data['nom'];
        $preom = $data['prenom'];

        $existingFormateur = $this->model->where('nom', $nom)->where('prenom', $preom)->exists();
        if ($existingFormateur) {
            throw FormateurException::AlreadyExistFormateur();
        }else{
            return parent::create($data);
        }
    }


    public function paginate($search = [], $perPage = 3, array $columns = ['*']): LengthAwarePaginator
    {
        if ($this->type !== null) {
            return $this->model->where('type', $this->type)->paginate($perPage, $columns);
        } else {
            return $this->model->paginate($perPage, $columns);
        }
    }

    /**
     * Recherche apprenants correspondants aux critères spécifiés.
     *
     * @param mixed $searchableData Données de recherche.
     * @param int $perPage Nombre d'éléments par page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchData($searchableData, $perPage = 10)
    {
        return $this->model->where('type', 'Formateur')->where(function($query) use ($searchableData) {
            $query->where('nom', 'like', '%' . $searchableData . '%')
                  ->orWhere('prenom', 'like', '%' . $searchableData . '%');
        })->paginate($perPage);
    }
}
