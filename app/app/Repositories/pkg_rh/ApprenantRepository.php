<?php

namespace App\Repositories\pkg_rh;

use App\Models\User;
use App\Models\pkg_rh\Apprenant;
use App\Repositories\BaseRepository;
use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\ApprenantAlreadyExistException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApprenantRepository extends BaseRepository
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
        $this->type = "Apprenant";
        parent::__construct(new Apprenant());
    }

    public function create(array $data)
    {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        
        $existingApprenant = $this->model->where('nom', $nom)->where('prenom', $prenom)->exists();
        if ($existingApprenant) {
            throw ApprenantException::AlreadyExistApprenant();
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

    public function getAll(){
        return $this->model->with('user')->get();
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
        return $this->model->where('type', 'Apprenant')->where(function($query) use ($searchableData) {
            $query->where('nom', 'like', '%' . $searchableData . '%')
                  ->orWhere('prenom', 'like', '%' . $searchableData . '%');
        })->paginate($perPage);
    }
}