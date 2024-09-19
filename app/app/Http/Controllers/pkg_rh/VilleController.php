<?php

namespace App\Http\Controllers\pkg_rh;

use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\VilleException;
use App\Exports\pkg_rh\ApprenantExport;
use App\Exports\pkg_rh\VilleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_rh\PersonneRequest;
use App\Http\Requests\pkg_rh\VilleRequest;
use App\Imports\pkg_creation_projets\ApprenantImport;
use App\Imports\pkg_creation_projets\VilleImport;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Ville;
use App\Models\User;
use App\Repositories\pkg_rh\GroupeRepository;
use App\Repositories\pkg_rh\NiveauScolaireRepository;
use App\Repositories\pkg_rh\SpecialiteRepository;
use App\Repositories\pkg_rh\VilleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class VilleController extends Controller
{

    protected $VilleRepository;

    public function __construct(VilleRepository $VilleRepository)
    {
        $this->VilleRepository = $VilleRepository;
    }
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(" ", "%", $searchValue);
                $Villes = $this->VilleRepository->searchData($searchQuery);

                return view('pkg_rh.Villes.index', compact('Villes'))->render();
            }
        }
        $Villes = $this->VilleRepository->paginate();
        return view('pkg_rh.Villes.index', compact('Villes'));
    }


    public function create()
    {
        $dataToEdit = NULL;
        return view('pkg_rh.Villes.create', compact('dataToEdit'));
    }

    public function store(VilleRequest $villeRequest)
    {
        try {
            $data = $villeRequest->validated();
            $this->VilleRepository->create($data);
            return redirect()->route('Villes.index')->with('success', __('pkg_rh/Ville.singular') . ' ' . __('app.addSucées'));
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $personne = $this->VilleRepository->find($id);
        return view('pkg_rh.Villes.show', compact('personne'))->with('type', $type);
    }

    public function edit($id)
    {
        $dataToEdit = $this->VilleRepository->find($id);
        return view('pkg_rh.Villes.edit',compact('dataToEdit'));
    }

    public function update(VilleRequest $villeRequest, $id)
    {
        try {
            $data = $villeRequest->validated(); 
            $this->VilleRepository->update($id, $data);

            return redirect()->route('Villes.index')->with('success', __('pkg_rh/Ville.singular') . ' ' . __('app.updateSucées'));

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $this->VilleRepository->destroy($id);
        return redirect()->route('Villes.index')->with('success',  __('pkg_rh/Ville.singular') . ' ' . ' a été supprimée avec succès');
    }

    public function export()
    {
        $villes = $this->VilleRepository->all();
        return Excel::download(new VilleExport($villes), 'Villes.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new VilleImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Villes.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Villes.index')->with('success', __('pkg_rh/Ville.singular') . ' ' . __('app.addSucées'));
    }


}