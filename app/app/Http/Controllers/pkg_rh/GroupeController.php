<?php

namespace App\Http\Controllers\pkg_rh;

use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\GroupeException;
use App\Exports\pkg_rh\ApprenantExport;
use App\Exports\pkg_rh\GroupeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_rh\PersonneRequest;
use App\Http\Requests\pkg_rh\GroupeRequest;
use App\Imports\pkg_creation_projets\ApprenantImport;
use App\Imports\pkg_creation_projets\GroupeImport;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Groupe;
use App\Models\User;
use App\Repositories\pkg_rh\NiveauScolaireRepository;
use App\Repositories\pkg_rh\SpecialiteRepository;
use App\Repositories\pkg_rh\GroupeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class GroupeController extends Controller
{

    protected $GroupeRepository;

    public function __construct(GroupeRepository $GroupeRepository)
    {
        $this->GroupeRepository = $GroupeRepository;
    }
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(" ", "%", $searchValue);
                $Groupes = $this->GroupeRepository->searchData($searchQuery);

                return view('pkg_rh.Groupes.index', compact('Groupes'))->render();
            }
        }
        $Groupes = $this->GroupeRepository->paginate();
        return view('pkg_rh.Groupes.index', compact('Groupes'));
    }


    public function create()
    {
        $dataToEdit = NULL;
        return view('pkg_rh.Groupes.create', compact('dataToEdit'));
    }

    public function store(GroupeRequest $GroupeRequest)
    {
        try {
            $data = $GroupeRequest->validated();
            $this->GroupeRepository->create($data);
            return redirect()->route('Groupes.index')->with('success', __('pkg_rh/Groupe.singular') . ' ' . __('app.addSucées'));
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $Groupe = $this->GroupeRepository->find($id);
        return view('pkg_rh.Groupes.show', compact('Groupe'));
    }

    public function edit($id)
    {
        $dataToEdit = $this->GroupeRepository->find($id);
        return view('pkg_rh.Groupes.edit',compact('dataToEdit'));
    }

    public function update(GroupeRequest $GroupeRequest, $id)
    {
        try {
            $data = $GroupeRequest->validated(); 
            $this->GroupeRepository->update($id, $data);

            return redirect()->route('Groupes.index')->with('success', __('pkg_rh/Groupe.singular') . ' ' . __('app.updateSucées'));

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $this->GroupeRepository->destroy($id);
        return redirect()->route('Groupes.index')->with('success',  __('pkg_rh/Groupe.singular') . ' ' . ' a été supprimée avec succès');
    }

    public function export()
    {
        $Groupes = $this->GroupeRepository->all();
        return Excel::download(new GroupeExport($Groupes), 'Groupes.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new GroupeImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Groupes.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Groupes.index')->with('success', __('pkg_rh/Groupe.singular') . ' ' . __('app.addSucées'));
    }

    

}