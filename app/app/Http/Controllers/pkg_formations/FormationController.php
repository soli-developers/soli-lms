<?php

namespace App\Http\Controllers\pkg_formations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_formations\FormationRequest;
use App\Repositories\pkg_formations\FormationRepository;
use App\Imports\pkg_formations\FormationsImport;
use App\Exports\pkg_formations\FormationsExport;
use Maatwebsite\Excel\Facades\Excel;


class FormationController extends Controller
{
    protected $formationRepository;

    public function __construct(FormationRepository $formationRepository)
    {
        $this->formationRepository = $formationRepository;
    }

    public function index(Request $request)
    {
        $searchValue = $request->input('search');
        $formationData = $this->formationRepository->searchData($searchValue, 2);
        return view('GestionFormation.Formation.index', compact('formationData'));
    }


    public function create()
    {  
        $dataToEdit = null;
        return view('GestionFormation.Formation.create', compact('dataToEdit'));
    }

    public function store(FormationRequest $request)
    {
        $validatedData = $request->validated();
        $formation = $this->formationRepository->create($validatedData);
        return redirect()->route('formations.index')->with('success', 'La formation a été ajoutée avec succès.');
    }

    public function show(Request $request, $id)
    {
        $formation = $this->formationRepository->find($id);
        return view('GestionFormation.Formation.show', compact('formation'));
    }

    public function edit($id)
    {
        $dataToEdit = $this->formationRepository->find($id);
        return view('GestionFormation.Formation.edit', compact('dataToEdit'));
    }

    public function update(FormationRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->formationRepository->update($id, $validatedData);
        return redirect()->route('formations.index')->with('success', 'La formation a été modifiée avec succès.');
    }

    public function destroy($id)
    {
        $this->formationRepository->destroy($id);
        return redirect()->route('formations.index')->with('success', 'La formation a été supprimée avec succès.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
    
        try {
            Excel::import(new FormationsImport, $request->file('file'));
            return redirect()->route('Formations.index')->with('success', 'Les Formations ont été importés avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('Formations.index')->with('error', 'Une erreur s\'est produite lors de l\'importation des Formations. Veuillez vérifier votre fichier Excel.');
        }
    }

    public function export()
    {
        return Excel::download(new FormationsExport, 'Formations.xlsx'); // Add 'return' 
    }

}
