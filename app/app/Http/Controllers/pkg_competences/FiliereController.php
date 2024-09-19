<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\FiliereAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\FiliereImport;
use App\Models\pkg_competences\Filiere;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\FiliereRequest;
use App\Repositories\pkg_competences\FiliereRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\FiliereExport;
use Maatwebsite\Excel\Facades\Excel;

class FiliereController extends AppBaseController
{
    protected $FiliereRepository;

    public function __construct(FiliereRepository $FiliereRepository)
    {
        $this->FiliereRepository = $FiliereRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $FiliereData = $this->FiliereRepository->searchData($searchQuery);
                return view('pkg_competences.Filiere.index', compact('FiliereData'))->render();
            }
        }
        $FiliereData = $this->FiliereRepository->paginate();
        return view('pkg_competences.Filiere.index', compact('FiliereData'));
    }

    public function create()
    {
        $dataToEdit = null;
        return view('pkg_competences.Filiere.create', compact('dataToEdit'));
    }

    public function store(FiliereRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->FiliereRepository->create($validatedData);
            return redirect()->route('Filiere.index')->with('success', __('messages.create_success'));
        } catch (FiliereAlreadyExistException $e) {
            return back()->withInput()->withErrors(['Filiere_exists' => 'Filiere est déjà existant']);
        }



    }

    public function show(string $id)
    {

        $fetchedData = $this->FiliereRepository->find((int)$id);
        return view('pkg_competences.Filiere.show', compact('fetchedData'));
    }

    public function edit(string $id)
    {
        $dataToEdit = $this->FiliereRepository->find((int)$id);

        return view('pkg_competences.Filiere.edit', compact('dataToEdit'));
    }

    public function update(FiliereRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->FiliereRepository->update($id, $validatedData);
        return redirect()->route('Filiere.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
        $this->FiliereRepository->destroy($id);
        return redirect()->route('Filiere.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $Filiere = Filiere::all();
        return Excel::download(new FiliereExport($Filiere), 'Filiere_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new FiliereImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Filiere.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Filiere.index')->with('success', __('pkg_competences/Filiere.singular') . ' ' . __('app.addSucées'));
    }
}
