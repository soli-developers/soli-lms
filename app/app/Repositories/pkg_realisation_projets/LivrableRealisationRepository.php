<?php

namespace App\Repositories\pkg_realisation_projets;

use App\Models\pkg_realisation_projets\LivrableRealisation;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;


class LivrableRealisationRepository extends BaseRepository
{
    protected $model;

    public function __construct(LivrableRealisation $livrableRealisation)
    {
        parent::__construct(new LivrableRealisation());
    }
// In the LivrableRealisationRepository.php file, update the getFieldsSearchable method signature to match the one in the BaseRepository

public function getFieldsSearchable(): array
{
    return ['nom', 'lien']; // Add the fields you want to make searchable
}

public function create(array $data)
{
    $titre = $data['nom'];
    $lien = $data['lien'];
    $realisation_projet_id = $data['realisation_projet_id'];
    $description = $data['description'];
    // dd($lien);

    $existingLivrable = $this->model->where('nom', $titre)->orWhere('lien', $lien)->exists();

    // if ($existingLivrable) {
    //     throw new LivrableAlreadyExistException("Livrable with the same title or link already exists.");
    // } else {
    // }
return parent::create($data);
}

}