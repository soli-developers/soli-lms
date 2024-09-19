<?php

namespace App\Http\Controllers\pkg_competences;

use App\Exceptions\pkg_competences\ModuleAlreadyExistException;
use App\Http\Controllers\Controller;
use App\Imports\pkg_competences\ModuleImport;
use App\Models\pkg_competences\Module;
use Illuminate\Http\Request;
use App\Http\Requests\pkg_competences\ModuleRequest;
use App\Repositories\pkg_competences\ModuleRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use App\Exports\pkg_competences\ModuleExport;
use Maatwebsite\Excel\Facades\Excel;

class ModuleController extends AppBaseController
{
    protected $ModuleRepository;

    public function __construct(ModuleRepository $ModuleRepository)
    {
        $this->ModuleRepository = $ModuleRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->get('searchValue');
            if ($searchValue !== '') {
                $searchQuery = str_replace(' ', '%', $searchValue);
                $ModuleData = $this->ModuleRepository->searchData($searchQuery);
                return view('pkg_competences.Module.index', compact('ModuleData'))->render();
            }
        }
        $ModuleData = $this->ModuleRepository->paginate();
        return view('pkg_competences.Module.index', compact('ModuleData'));
    }

    public function create()
    {
        $dataToEdit = null;
        return view('pkg_competences.Module.create', compact('dataToEdit'));
    }

    public function store(ModuleRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->ModuleRepository->create($validatedData);
            return redirect()->route('Module.index')->with('success', __('messages.create_success'));
        } catch (ModuleAlreadyExistException $e) {
            return back()->withInput()->withErrors(['Module_exists' => 'Module est déjà existant']);

        }



    }

    public function show(string $id)
    {

        $fetchedData = $this->ModuleRepository->find($id);
        return view('pkg_competences.Module.show', compact('fetchedData'));
    }

    public function edit(string $id)
    {
        $dataToEdit = $this->ModuleRepository->find($id);

        return view('pkg_competences.Module.edit', compact('dataToEdit'));
    }

    public function update(ModuleRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $this->ModuleRepository->update($id, $validatedData);
        return redirect()->route('Module.index')->with('success', __('messages.update_success'));
    }

    public function destroy(string $id)
    {
        $this->ModuleRepository->destroy($id);
        return redirect()->route('Module.index')->with('success', __('messages.delete_success'));
    }

    public function export()
    {
        $Module = Module::all();
        return Excel::download(new ModuleExport($Module), 'Module_export.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new ModuleImport, $request->file('file'));
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('Module.index')->withError('Le symbole de séparation est introuvable. Pas assez de données disponibles pour satisfaire au format.');
        }
        return redirect()->route('Module.index')->with('success', __('pkg_competences/Module.singular') . ' ' . __('app.addSucées'));
    }
}
