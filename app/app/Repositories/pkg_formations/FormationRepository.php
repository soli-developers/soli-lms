<?php

namespace App\Repositories\pkg_formations;

use App\Exceptions\GestionFormations\FormationAlreadyExistException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\pkg_formations\Formation;
use Illuminate\Pagination\LengthAwarePaginator;



class FormationRepository extends BaseRepository
{
    /**
     * Les champs de recherche disponibles pour les formations.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'nom','description'
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
     * Constructeur de la classe FormationRepository.
     */
    public function __construct()
    {
        parent::__construct(new Formation());
    }

    public function create(array $data)
    {
        $nom = $data['nom'];
    
        $existingFormation =  $this->model->where('nom', $nom)->exists();
    
        if ($existingFormation) {
            throw FormationAlreadyExistException::createFormation();
        } else {
            // Ajout du lien et de la clé étrangère formateur_id
            $formation = parent::create($data);
    
            // Vérifie si le lien est présent dans les données et l'associe à la formation
        
                $formation->lien = $data['lien'];
                $formation->lien1 = $data['lien1'];
                $formation->save();
    


    
    
            // Vérifie si le formateur_id est présent dans les données et l'associe à la formation
            if (isset($data['formateur_id'])) {
                $formation->formateur_id = $data['formateur_id'];
                $formation->save();
            }
    
            return $formation;
        }
    }
     
     /**
     * Met à jour une formation existante.
     *
     * @param int $id
     * @param array $data
     * @return Formation
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $formation = $this->model->findOrFail($id);
        $formation->update($data);

        if (isset($data['lien'])) {
            $formation->lien = $data['lien'];
        }

        if (isset($data['formateur_id'])) {
            $formation->formateur_id = $data['formateur_id'];
        }

        $formation->save();
        return $formation;
    }

    /**
     * Supprime une formation par son identifiant.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $formation = $this->model->findOrFail($id);
        return $formation->delete();
    }
     
    
    /**
     * Recherche les formations correspondants aux critères spécifiés.
     *
     * @param mixed $searchableData Données de recherche.
     * @param int $perPage Nombre d'éléments par page.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchData($searchableData, $perPage = 10)
{
    return $this->model->where(function ($query) use ($searchableData) {
        $query->where('nom', 'like', '%' . $searchableData . '%')
            ->orWhere('description', 'like', '%' . $searchableData . '%');
    })->paginate($perPage);
}
    
    // Other methods...

    

    


    
}
