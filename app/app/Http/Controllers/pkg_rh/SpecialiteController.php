<?php

namespace App\Http\Controllers\pkg_rh;

use App\Exceptions\pkg_rh\ApprenantException;
use App\Exceptions\pkg_rh\SpecialiteException;
use App\Exports\pkg_rh\ApprenantExport;
use App\Exports\pkg_rh\SpecialiteExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_rh\PersonneRequest;
use App\Http\Requests\pkg_rh\SpecialiteRequest;
use App\Imports\pkg_creation_projets\ApprenantImport;
use App\Imports\pkg_creation_projets\SpecialiteImport;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Specialite;
use App\Models\User;
use App\Repositories\pkg_rh\GroupeRepository;
use App\Repositories\pkg_rh\NiveauScolaireRepository;
use App\Repositories\pkg_rh\SpecialiteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SpecialiteController extends Controller
{

    protected $SpecialiteRepository;

    public function __construct(SpecialiteRepository $SpecialiteRepository)
    {
        $this->SpecialiteRepository = $SpecialiteRepository;
    }
    public function index(Request $request)
    {
        

        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(" ", "%", $searchValue);
                $Specialites = $this->SpecialiteRepository->searchData($searchQuery);

                return view('pkg_rh.Specialites.index', compact('Specialites'))->render();
            }
        }
        $Specialites = $this->SpecialiteRepository->paginate();
        return view('pkg_rh.Specialites.index', compact('Specialites'));
    }


    public function create()
    {
        $dataToEdit = NULL;
        return view('pkg_rh.Specialites.create', compact('dataToEdit'));
    }

    public function store(SpecialiteRequest $SpecialiteRequest)
    {
        try {
            $data = $SpecialiteRequest->validated();
            $this->SpecialiteRepository->create($data);
            return redirect()->route('Specialite.index')->with('success', __('pkg_rh/Specialite.singular') . ' ' . __('app.addSucées'));
        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $personne = $this->SpecialiteRepository->find($id);
        return view('pkg_rh.Specialites.show', compact('personne'))->with('type', $type);
    }

    public function edit($id)
    {
        $dataToEdit = $this->SpecialiteRepository->find($id);
        return view('pkg_rh.Specialites.edit',compact('dataToEdit'));
    }

    public function update(SpecialiteRequest $SpecialiteRequest, $id)
    {
        try {
            $data = $SpecialiteRequest->validated(); 
            $this->SpecialiteRepository->update($id, $data);

            return redirect()->route('Specialite.index')->with('success', __('pkg_rh/Specialite.singular') . ' ' . __('app.updateSucées'));

        }catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $this->SpecialiteRepository->destroy($id);
        return redirect()->route('Specialite.index')->with('success',  __('pkg_rh/Specialite.singular') . ' ' . ' a été supprimée avec succès');
    }

    public function export()
    {
        $Specialites = $this->SpecialiteRepository->all();
        return Excel::download(new SpecialiteExport($Specialites), 'Specialites.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new SpecialiteImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Specialite.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Specialite.index')->with('success', __('pkg_rh/Specialite.singular') . ' ' . __('app.addSucées'));
    }


}