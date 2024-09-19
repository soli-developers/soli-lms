<?php

namespace App\Http\Controllers\pkg_rh;

use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\NiveauxScolaireException;
use App\Exports\pkg_rh\ApprenantExport;
use App\Exports\pkg_rh\NiveauxScolaireExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_rh\PersonneRequest;
use App\Http\Requests\pkg_rh\NiveauxScolaireRequest;
use App\Imports\pkg_creation_projets\ApprenantImport;
use App\Imports\pkg_creation_projets\NiveauxScolaireImport;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\NiveauxScolaire;
use App\Models\User;
use App\Repositories\pkg_rh\GroupeRepository;
use App\Repositories\pkg_rh\NiveauScolaireRepository;
use App\Repositories\pkg_rh\SpecialiteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class NiveauxScolaireController extends Controller
{

    protected $NiveauScolaireRepository;

    public function __construct(NiveauScolaireRepository $NiveauScolaireRepository)
    {
        $this->NiveauScolaireRepository = $NiveauScolaireRepository;
    }
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(" ", "%", $searchValue);
                $NiveauxScolaires = $this->NiveauScolaireRepository->searchData($searchQuery);

                return view('pkg_rh.NiveauxScolaires.index', compact('NiveauxScolaires'))->render();
            }
        }
        $NiveauxScolaires = $this->NiveauScolaireRepository->paginate();
        return view('pkg_rh.NiveauxScolaires.index', compact('NiveauxScolaires'));
    }


    public function create()
    {
        $dataToEdit = NULL;
        return view('pkg_rh.NiveauxScolaires.create', compact('dataToEdit'));
    }

    public function store(NiveauxScolaireRequest $NiveauxScolaireRequest)
    {
        try {
            $data = $NiveauxScolaireRequest->validated();
            $this->NiveauScolaireRepository->create($data);
            return redirect()->route('NiveauxScolaire.index')->with('success', __('pkg_rh/NiveauScolaire.singular') . ' ' . __('app.addSucées'));
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $personne = $this->NiveauScolaireRepository->find($id);
        return view('pkg_rh.NiveauxScolaires.show', compact('personne'));
    }

    public function edit($id)
    {
        $dataToEdit = $this->NiveauScolaireRepository->find($id);
        return view('pkg_rh.NiveauxScolaires.edit',compact('dataToEdit'));
    }

    public function update(NiveauxScolaireRequest $NiveauxScolaireRequest, $id)
    {
        try {
            $data = $NiveauxScolaireRequest->validated(); 
            $this->NiveauScolaireRepository->update($id, $data);

            return redirect()->route('NiveauxScolaire.index')->with('success', __('pkg_rh/NiveauScolaire.singular') . ' ' . __('app.updateSucées'));

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $this->NiveauScolaireRepository->destroy($id);
        return redirect()->route('NiveauxScolaire.index')->with('success',  __('pkg_rh/NiveauScolaire.singular') . ' ' . ' a été supprimée avec succès');
    }

    public function export()
    {
        $NiveauxScolaires = $this->NiveauScolaireRepository->all();
        return Excel::download(new NiveauxScolaireExport($NiveauxScolaires), 'NiveauxScolaires.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new NiveauxScolaireImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('NiveauxScolaire.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('NiveauxScolaire.index')->with('success', __('pkg_rh/NiveauScolaire.singular') . ' ' . __('app.addSucées'));
    }


}