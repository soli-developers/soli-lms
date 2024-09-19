<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\categorietechnologieException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\CategorieTechnologieImport;
use App\Models\pkg_competences\CategorieTechnologie;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\CategorieTechnologieRequest;
use App\Repositories\pkg_competences\CategorieTechnologieRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\CategorieTechnologieExport;
use Maatwebsite\Excel\Facades\Excel;

class CategorieTechnologieController extends AppBaseController
{
    protected $CategorieTechnologieRepository;

    public function __construct(CategorieTechnologieRepository $CategorieTechnologieRepository)
    {
        $this->CategorieTechnologieRepository = $CategorieTechnologieRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $CategorieTechnologieData = $this->CategorieTechnologieRepository->searchData($searchQuery);
                return view('pkg_competences.CategorieTechnologie.index', compact('CategorieTechnologieData'))->render();
            }
        }
        $CategorieTechnologieData = $this->CategorieTechnologieRepository->paginate();
        return view('pkg_competences.CategorieTechnologie.index', compact('CategorieTechnologieData'));
    }

    public function create()
    {
        
        return view('pkg_competences.CategorieTechnologie.create', compact('dataToEdit'));
    }

    public function store(CategorieTechnologieRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->CategorieTechnologieRepository->create($validatedData);
            return redirect()->route('CategorieTechnologie.index')->with('success', __('messages.create_success'));
        } catch (categorietechnologieException $e) {
            return back()->withInput()->withErrors(['competence_exists' => 'Categorie Technologie est déjà existant']);

        }



    }

    public function show(string $id)
{
    $fetchedData = $this->CategorieTechnologieRepository->find((int)$id);

    if (!$fetchedData) {
        return redirect()->route('CategorieTechnologie.index')->withErrors(__('messages.not_found'));
    }

    return view('pkg_competences.CategorieTechnologie.show', compact('fetchedData'));
}

    public function edit(string $id)
    {
    $dataToEdit = $this->CategorieTechnologieRepository->find((int)$id);
    return view('pkg_competences.CategorieTechnologie.edit', compact('dataToEdit'));
    }

    public function update(CategorieTechnologieRequest $request, string $id)
    {
    $validatedData = $request->validated();
    $this->CategorieTechnologieRepository->update((int)$id, $validatedData);
    return redirect()->route('CategorieTechnologie.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
    $this->CategorieTechnologieRepository->destroy((int)$id);
    return redirect()->route('CategorieTechnologie.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $CategorieTechnologie = CategorieTechnologie::all();
        return Excel::download(new CategorieTechnologieExport($CategorieTechnologie), 'CategorieTechnologie_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new CategorieTechnologieImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('CategorieTechnologie.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('CategorieTechnologie.index')->with('success', __('pkg_competences/CategorieTechnologie.singular') . ' ' . __('app.addSucées'));
    }
}
