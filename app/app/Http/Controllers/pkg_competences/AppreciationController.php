<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\AppreciationAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\AppreciationImport;
use App\Models\pkg_competences\Appreciation;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\AppreciationRequest;
use App\Repositories\pkg_competences\AppreciationRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\AppreciationExport;
use Maatwebsite\Excel\Facades\Excel;

class AppreciationController extends AppBaseController
{
    protected $AppreciationRepository;

    public function __construct(AppreciationRepository $AppreciationRepository)
    {
        $this->AppreciationRepository = $AppreciationRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $AppreciationData = $this->AppreciationRepository->searchData($searchQuery);
                return view('pkg_competences.Appreciation.index', compact('AppreciationData'))->render();
            }
        }
        $AppreciationData = $this->AppreciationRepository->paginate();
        return view('pkg_competences.Appreciation.index', compact('AppreciationData'));
    }

    public function create()
    {
        $dataToEdit = null;
        return view('pkg_competences.Appreciation.create', compact('dataToEdit'));
    }

    public function store(AppreciationRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->AppreciationRepository->create($validatedData);
            return redirect()->route('Appreciation.index')->with('success', __('messages.create_success'));
        } catch (AppreciationAlreadyExistException $e) {
            return back()->withInput()->withErrors(['competence_exists' => 'Appreciation est déjà existant']);

        }



    }

    public function show(string $id)
    {

        $fetchedData = $this->AppreciationRepository->find((int)$id);
        return view('pkg_competences.Appreciation.show', compact('fetchedData'));
    }

    public function edit(string $id)
    {
        $dataToEdit = $this->AppreciationRepository->find((int)$id);

        return view('pkg_competences.Appreciation.edit', compact('dataToEdit'));
    }

    public function update(AppreciationRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->AppreciationRepository->update($id, $validatedData);
        return redirect()->route('Appreciation.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
        $this->AppreciationRepository->destroy((int)$id);
        return redirect()->route('Appreciation.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $Appreciation = Appreciation::all();
        return Excel::download(new AppreciationExport($Appreciation), 'Appreciation_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new AppreciationImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Appreciation.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Appreciation.index')->with('success', __('pkg_competences/Appreciation.singular') . ' ' . __('app.addSucées'));
    }
}
