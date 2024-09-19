<?php

namespace App\Http\Controllers\pkg_rh;

use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\FormateurException;
use App\Exports\pkg_rh\ApprenantExport;
use App\Exports\pkg_rh\FormateurExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_rh\FormateurRequest;
use App\Http\Requests\pkg_rh\PersonneRequest;
use App\Imports\pkg_rh\ApprenantImport;
use App\Imports\pkg_rh\FormateurImport;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Formateur;
use App\Models\User;
use App\Repositories\pkg_rh\GroupeRepository;
use App\Repositories\pkg_rh\NiveauScolaireRepository;
use App\Repositories\pkg_rh\SpecialiteRepository;
use App\Repositories\pkg_rh\VilleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PersonneController extends Controller
{

    
    public function index(Request $request)
    {
        
        $type = $this->getType();

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(" ", "%", $searchValue);
                $personnes = $this->getRepository()->searchData($searchQuery);

                return view('pkg_rh.Personnes.index', compact('personnes', 'type'))->render();
            }
        }
        $personnes = $this->getRepository()->paginate();
        return view('pkg_rh.Personnes.index', compact('personnes', 'type'));
    }


    public function create()
    {
        $dataToEdit = NULL;
        $type = $this->getType();
        $GroupRepositorie = new GroupeRepository();
        $NiveauxScolaireRepository = new NiveauScolaireRepository();
        $VilleRepository = new VilleRepository();
        $SpecialiteRepository = new SpecialiteRepository();

        $groupes = $GroupRepositorie->all();
        $specialites = $SpecialiteRepository->all();
        $villes = $VilleRepository->all();
        $niveauxScolaire = $NiveauxScolaireRepository->all();

        return view('pkg_rh.Personnes.create',compact('type','groupes','specialites', 'villes', 'niveauxScolaire', 'dataToEdit'));
    }

    public function store(PersonneRequest $personneRequest)
    {
        try {
            $type = $this->getType();
            $data = $personneRequest->validated();
            $user = User::create(["email" => $data['email'],"password" => $data['password'], 'remember_token' => $data['_token']]);
            $data += ['type' => $type,'profile_image' => 'default_profile_image.png', 'user_id' => $user->id];
            $this->getRepository()->create($data);
            return redirect()->route($type . '.index')->with('success', __('pkg_rh/'.$type.'.singular') . ' ' . __('app.addSucées'));
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $type = $this->getType();
        $personne = $this->getRepository()->find($id);
        return view('pkg_rh.Personnes.show', compact('personne'))->with('type', $type);
    }

    public function edit($id)
    {
        $type = $this->getType();
        $dataToEdit = $this->getRepository()->find($id);

        $GroupRepositorie = new GroupeRepository();
        $NiveauxScolaireRepository = new NiveauScolaireRepository();
        $VilleRepository = new VilleRepository();
        $SpecialiteRepository = new SpecialiteRepository();

        $groupes = $GroupRepositorie->all();
        $specialites = $SpecialiteRepository->all();
        $villes = $VilleRepository->all();
        $niveauxScolaire = $NiveauxScolaireRepository->all();

        return view('pkg_rh.Personnes.edit',compact('type','groupes','specialites', 'villes', 'niveauxScolaire', 'dataToEdit'));

    }

    public function update(PersonneRequest $personneRequest, $id)
    {
        try {
            $type = $this->getType();
            $data = $personneRequest->validated(); 
            $this->getRepository()->update($id, $data);

            return redirect()->route($type . '.index')->with('success', __('pkg_rh/'.$type.'.singular') . ' ' . __('app.updateSucées'));

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $type = $this->getType();
        $personne = $this->getRepository()->destroy($id);
        return redirect()->route($type.'.index')->with('success', __('pkg_rh/'.$type.'.singular'). ' a été supprimée avec succès');
    }

    public function export()
    {
        $type = $this->getType();
        $personne = $this->getRepository()->getAll()->where('type', $type);
        $export = $type == "Formateur" ? new FormateurExport($personne) : new ApprenantExport($personne);
        return Excel::download($export, $type.'.xlsx');
    }


    public function import(Request $request)
    {
        $type = $this->getType();
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $import = $type == "Formateur" ? new FormateurImport : new ApprenantImport;

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Exception $e) {
            return redirect()->route($type.'.index')->withError($e->getMessage());
        }catch (\InvalidArgumentException $e) {
            return redirect()->route($type.'.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route($type.'.index')->with('success', __('pkg_rh/'.$type.'.singular') . ' ' . __('app.addSucées'));
    }



    private function getRepository(){
        $route = Route::getCurrentRoute()->getName();
        $type = explode('.',$route);
        $model = str::ucfirst($type[0]);
        $modelRepository = $model.'Repository';
        $path = "\\App\\Repositories\\pkg_rh\\".$modelRepository;

        if($model === 'Formateur'){
            $repository = new $path();
        }elseif($model === 'Apprenant'){
            $repository = new $path();
        }
        return $repository;
    }

    private function getType(){
        $route = Route::getCurrentRoute()->getName();
        $type = explode('.',$route);
        return $type[0];
    }

}