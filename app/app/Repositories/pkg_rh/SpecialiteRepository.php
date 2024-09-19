<?php
namespace App\Repositories\pkg_rh;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\pkg_rh\SpecialiteException;
use App\Models\pkg_rh\Specialite;

class SpecialiteRepository extends BaseRepository
{
    protected $fieldsSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldsSearchable;
    }
    public function __construct()
    {
        parent::__construct(new Specialite());
    }

    public function create(array $data)
    {
        $nom = $data['nom'];

        $existingSpecialite =  $this->model->where('nom', $nom)->exists();

        if ($existingSpecialite) {
            throw SpecialiteException::AlreadyExistSpecialite();
        } else {
            return parent::create($data);
        }
    }

    public function update($id, array $data)
    {
        $nom = $data['nom'];

        $existingSpecialite =  $this->model->where('nom', $nom)->where('id', '!=', $id)->exists();

        if ($existingSpecialite) {
            throw SpecialiteException::AlreadyExistSpecialite();
        } else {
            return parent::update($id, $data);
        }
    }

    public function searchData($searchableData, $perPage = 4)
    {
        return $this->model->where(function($query) use ($searchableData) {
            $query->where('nom', 'like', '%' . $searchableData . '%');
        })->paginate($perPage);
    }

}