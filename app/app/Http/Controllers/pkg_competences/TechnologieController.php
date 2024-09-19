<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\TechnologieAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\TechnologieImport;
use App\Models\pkg_competences\Technologie;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\TechnologieRequest;
use App\Repositories\pkg_competences\TechnologieRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\TechnologieExport;
use Maatwebsite\Excel\Facades\Excel;

class TechnologieController extends AppBaseController
{
    protected $TechnologieRepository;

    public function __construct(TechnologieRepository $TechnologieRepository)
    {
        $this->TechnologieRepository = $TechnologieRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $TechnologieData = $this->TechnologieRepository->searchData($searchQuery);
                return view('pkg_competences.technologie.index', compact('TechnologieData'))->render();
            }
        }
        $TechnologieData = $this->TechnologieRepository->paginate();
        return view('pkg_competences.technologie.index', compact('TechnologieData'));
    }

    public function create()
    {
        $dataToEdit = null;
        return view('pkg_competences.technologie.create', compact('dataToEdit'));
    }

    public function store(TechnologieRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->TechnologieRepository->create($validatedData);
            return redirect()->route('technologie.index')->with('success', __('messages.create_success'));
        } catch (TechnologieAlreadyExistException $e) {
            return back()->withInput()->withErrors(['Technologie_exists' => 'Technologie est déjà existant']);
        }
    }

    public function show(string $id)
    {
        $fetchedData = $this->TechnologieRepository->find((int)$id);
        return view('pkg_competences.technologie.show', compact('fetchedData'));
    }

    public function edit(string $id)
    {
        $dataToEdit = $this->TechnologieRepository->find((int)$id);
        return view('pkg_competences.technologie.edit', compact('dataToEdit'));
    }

    public function update(TechnologieRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->TechnologieRepository->update($id, $validatedData);
        return redirect()->route('technologie.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
        $this->TechnologieRepository->destroy((int)$id);
        return redirect()->route('technologie.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $Technologie = Technologie::all();
        return Excel::download(new TechnologieExport($Technologie), 'Technologie_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new TechnologieImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('technologie.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('technologie.index')->with('success', __('pkg_competences/Technologie.singular') . ' ' . __('app.addSucées'));
    }
}
