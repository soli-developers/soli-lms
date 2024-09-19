<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\niveauxCompetencesAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\NiveauCompetenceImport;
use App\Models\pkg_competences\NiveauCompetence;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\NiveauCompetenceRequest;
use App\Repositories\pkg_competences\niveauxCompetencesRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\NiveauCompetenceExport;
use Maatwebsite\Excel\Facades\Excel;

class NiveauCompetenceController extends AppBaseController
{
    protected $niveauxCompetencesRepository;

    public function __construct(niveauxCompetencesRepository $niveauxCompetencesRepository)
    {
        $this->niveauxCompetencesRepository = $niveauxCompetencesRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $NiveauCompetenceData = $this->niveauxCompetencesRepository->searchData($searchQuery);
                return view('pkg_competences.NiveauCompetence.index', compact('NiveauCompetenceData'))->render();
            }
        }
        $NiveauCompetenceData = $this->niveauxCompetencesRepository->paginate();
        return view('pkg_competences.NiveauCompetence.index', compact('NiveauCompetenceData'));
    }

    public function create()
    {
        $dataToEdit = null;
        return view('pkg_competences.NiveauCompetence.create', compact('dataToEdit'));
    }

    public function store(NiveauCompetenceRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->niveauxCompetencesRepository->create($validatedData);
            return redirect()->route('niveauxCompetencesRepository.index')->with('success', __('messages.create_success'));
        } catch (niveauxCompetencesAlreadyExistException $e) {
            return back()->withInput()->withErrors(['competence_exists' => 'NiveauCompetence est déjà existant']);
        }



    }

    public function show(string $id)
    {

        $fetchedData = $this->niveauxCompetencesRepository->find($id);
        return view('pkg_competences.competence.show', compact('fetchedData'));
    }

    public function edit(string $id)
    {
        $dataToEdit = $this->niveauxCompetencesRepository->find($id);

        return view('pkg_competences.competence.edit', compact('dataToEdit'));
    }

    public function update(NiveauCompetenceRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->niveauxCompetencesRepository->update($id, $validatedData);
        return redirect()->route('NiveauCompetence.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
        $this->niveauxCompetencesRepository->destroy($id);
        return redirect()->route('NiveauCompetence.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $NiveauCompetence = NiveauCompetence::all();
        return Excel::download(new NiveauCompetenceExport($NiveauCompetence), 'NiveauCompetence_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new NiveauCompetenceImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('NiveauCompetence.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('NiveauCompetence.index')->with('success', __('pkg_competences/NiveauCompetence.singular') . ' ' . __('app.addSucées'));
    }
}
