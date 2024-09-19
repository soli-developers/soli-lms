<?php
namespace App\Repositories\pkg_competences;

use App\Models\pkg_competences\NiveauCompetence;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_competences\niveauxCompetencesAlreadyExistException;

/**
 * Classe TaskRepository qui gère la persistance des NiveauCompetence dans la base de données.
 */
class niveauxCompetencesRepository extends BaseRepository
{
    /**
     * Les champs de recherche disponibles pour les NiveauCompetence.
     *
     * @var array
     */
    protected $fieldsSearchable = [
        'nom',
        'description',
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
     * Constructeur de la classe niveauxCompetencesRepository.
     */
    public function __construct()
    {
        parent::__construct(new NiveauCompetence());
    }

    /**
     * Crée un nouveau task.
     *
     * @param array $data Données du NiveauCompetence à créer.
     * @return mixed
     * @throws niveauxCompetencesAlreadyExistException Si le NiveauCompetence existe déjà.
     */
    public function create(array $data)
    {
        $nom = $data['nom'];
        $description = $data['description'];

        $existingNiveauCompetence =  $this->model->where('nom', $nom)->exists();
        $existingNiveauCompetence =  $this->model->where('description', $description)->exists();

        if ($existingNiveauCompetence) {
            throw niveauxCompetencesAlreadyExistException::createNiveauxCompetences();
        } else {
            return parent::create($data);
        }
    }

    /**
     * Recherche les NiveauCompetence correspondants aux critères spécifiés.
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
