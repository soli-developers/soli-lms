<?php

namespace App\Http\Controllers\pkg_creation_projets;

use App\Exports\pkg_creation_projets\ProjetExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_creation_projets\ProjetRequest;
use App\Http\Requests\pkg_creation_projets\ProjetStoreRequest;
use App\Imports\pkg_creation_projets\ProjetImport;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_competences\Appreciation;
use App\Models\pkg_competences\Technologie;
use App\Models\pkg_creation_projets\NatureLivrable;
use App\Models\pkg_rh\Apprenant;
use App\Models\pkg_rh\Personne;
use App\Repositories\pkg_competences\CompetenceRepository;
use App\Repositories\Pkg_competences\TechnologieRepository;
use App\Repositories\pkg_creation_projets\LivrableRepository;
use App\Repositories\pkg_creation_projets\ProjetRepository;
use App\Repositories\pkg_creation_projets\ResourceRepository;
use App\Repositories\pkg_creation_projets\TechnologieCompetenceRepository;
use App\Repositories\pkg_creation_projets\TransfertCompetenceRepository;
use App\Repositories\pkg_realisation_projets\ProjectRealisationRepository;
use App\Repositories\pkg_rh\ApprenantRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class ProjetController extends Controller
{
    protected $projetRepository;
    protected $livrableRepository;
    protected $resourceRepository;
    protected $competenceRepository;
    protected $technologieRepository;
    protected $apprenantRepository;
    protected $transfercompetenceRepository;
    protected $technologiecompetenceRepository;
    protected $projectRealisationRepository;

    public function __construct(
        ProjetRepository $projetRepository,
        LivrableRepository $livrableRepository,
        ResourceRepository $resourceRepository,
        CompetenceRepository $competenceRepository,
        TechnologieRepository $technologieRepository,
        ApprenantRepository $apprenantRepository,
        TransfertCompetenceRepository $transfercompetenceRepository,
        TechnologieCompetenceRepository $technologiecompetenceRepository,

        ProjectRealisationRepository $projectRealisationRepository,

    ) {
        $this->projetRepository = $projetRepository;
        $this->livrableRepository = $livrableRepository;
        $this->resourceRepository = $resourceRepository;
        $this->competenceRepository = $competenceRepository;
        $this->technologieRepository = $technologieRepository;
        $this->apprenantRepository = $apprenantRepository;
        $this->transfercompetenceRepository = $transfercompetenceRepository;
        $this->technologiecompetenceRepository = $technologiecompetenceRepository;
        $this->projectRealisationRepository = $projectRealisationRepository;
    }

    public function index(Request $request)
    {
        $projetData = $this->projetRepository->with([
            'livrables',
            'resources',
            'transfertCompetences.competence',
            'transfertCompetences.appreciation',
        ]);
        $competences = Competence::all();
        $searchValue = $request->get('searchValue');
        $competenceId = $request->get('competenceId');
        if ($request->ajax()) {


            if ($searchValue !== '' || $competenceId !== null) {
                $projetData = $this->projetRepository->filterAndSearch($competenceId, $searchValue);
                return view('pkg_creation_projets.table', compact('projetData','searchValue','competenceId'))->render();
            }

            $projetData = $this->projetRepository->paginate();
            return view('pkg_creation_projets.table', compact('projetData','searchValue','competenceId'))->render();
        }

        $projetData = $this->projetRepository->paginate();
        return view('pkg_creation_projets.index', compact('projetData', 'competences','searchValue','competenceId'));
    }








    public function create()
    {
        $dataToEdit = null;
        $apprenants = Personne::whereIn('type', ['Apprenant'])->get();
        $competences = Competence::all();
        $appreciations = Appreciation::all();
        $livrableNatures = NatureLivrable::all();
        $technologies = Technologie::all();
        return view('pkg_creation_projets.form', compact('dataToEdit', 'apprenants', 'competences', 'appreciations', 'livrableNatures','technologies'));
    }

    public function store(ProjetStoreRequest $request)
    {
        // 1. Validate the request data
        $validatedData = $request->validated();
        // dd($validatedData);
 // 2. Get the authenticated user's ID
 $userId = auth()->id();
//  dd($userId);

 // 3. Create the project using the repository
 $validatedData['formateur_id'] = $userId; // Set the formateur_id
        //  dd($validatedData);
        // 2. Create the project using the repository
        $projet = $this->projetRepository->create($validatedData);

        // 3. Create livrables (if any)
        if (isset($validatedData['livrable'])) {
            foreach ($validatedData['livrable'] as $index => $livrable) {
                $livrableData = [
                    'titre' => $livrable,
                    'description' => $validatedData['livrable_description'][$index] ?? null,
                    'lien' => $validatedData['livrable_link'][$index] ?? null,
                    'nature_livrable_id' => $validatedData['livrable_nature'][$index],
                    'projet_id' => $projet->id,
                ];
                $this->livrableRepository->create($livrableData);
            }
        }

        // 4. Create resources (if any)
        if (isset($validatedData['ressource_nom'])) {
            foreach ($validatedData['ressource_nom'] as $index => $ressource_nom) {
                $ressourceData = [
                    'nom' => $ressource_nom,
                    'description' => $validatedData['ressource_description'][$index] ?? null,
                    'lien' => $validatedData['ressource_lien'][$index] ?? null,
                    'projet_id' => $projet->id,
                ];
                $this->resourceRepository->create($ressourceData);
            }
        }


// 5. Update TransfertCompetence records
if (isset($validatedData['competences'])) {
    foreach ($validatedData['competences'] as $competence_id) {
        // Get the appreciation ID directly from the request
        $appreciation_id = $request->input('competence_' . $competence_id . '_appreciation');

        $transfertCompetenceData = [
            'projet_id' => $projet->id,
            'competence_id' => $competence_id,
            'appreciation_id' => $appreciation_id,
        ];

        $transfertCompetence = $this->transfercompetenceRepository->create($transfertCompetenceData);

        // Associate technologies with the TransfertCompetence
        if (isset($validatedData['technologie_ids'][$competence_id])) {
            $technologieIds = $validatedData['technologie_ids'][$competence_id];
            $transfertCompetence->technologies()->attach($technologieIds); // Use attach to associate
        }
    }
}

    if (isset($validatedData['apprenants'])) {
        foreach ($validatedData['apprenants'] as $apprenantId) {
            $realisationProjetData = [
                'projet_id' => $projet->id,
                'personne_id' => $apprenantId, // Assuming 'personne_id' is the apprenant ID field
                'date_debut_realisation' => now(), // Or set a default start date
                'date_fin_realisation' => now()->addDays(14), // Or set a default end date (example: 14 days)
                'etat_realisation_projet_id' => 1, // Or set a default state ID
            ];
            $this->projectRealisationRepository->create($realisationProjetData);
        }
    }

        // 8. Redirect with a success message
        return redirect()->route('projets.index')->with('success', 'Le projet a été ajouté avec succès.');
    }


    public function show(Request $request, $id)
    {
        $projet = $this->projetRepository->with([
            'livrables.natureLivrable',
            'resources',
            'transfertCompetences.competence',
            'transfertCompetences.appreciation',
            'transfertCompetences.technologies',
            'realisationProjets.personne'
        ])->findOrFail($id);
 // Get the learners associated with the project
 $learners = $projet->realisationProjets->pluck('personne'); // This will give you a collection of Personnes

 return view('pkg_creation_projets.show', compact('projet', 'learners'));     }

    public function edit($id)
    {
        $dataToEdit = $this->projetRepository->with([
            'livrables.natureLivrable', // Eager load natureLivrable relationship
            'resources',
            'transfertCompetences.competence',
            'transfertCompetences.appreciation',
            'transfertCompetences.technologies',
            'realisationProjets.personne' // Load apprentices through RealisationProjet
        ])->findOrFail($id);

        // Convert date strings to DateTime objects if they are not already
        if (!$dataToEdit->dateDebut instanceof \DateTime) {
            $dataToEdit->dateDebut = new \DateTime($dataToEdit->dateDebut);
        }
        if (!$dataToEdit->dateFin instanceof \DateTime) {
            $dataToEdit->dateFin = new \DateTime($dataToEdit->dateFin);
        }

        // Format dates
        $dateDebutFormatted = $dataToEdit->dateDebut->format('Y-m-d');
        $dateFinFormatted = $dataToEdit->dateFin->format('Y-m-d');

        // Fetch ALL apprentices
        $apprenants = Personne::whereIn('type', ['Apprenant'])->get();
        $competences = Competence::all();
        $appreciations = Appreciation::all();
        $livrableNatures = NatureLivrable::all();
        $technologies = Technologie::all();

        return view('pkg_creation_projets.form', compact(
            'dataToEdit',
            'dateDebutFormatted',
            'dateFinFormatted',
            'apprenants',
            'competences',
            'appreciations',
            'livrableNatures',
            'technologies'
        ));
    }





    public function update(ProjetStoreRequest $request, $id)
    {
        // 1. Validate the request data
        $validatedData = $request->validated();

        // 2. Find the project
        $projet = $this->projetRepository->find($id);

        // 3. Update the project
        $projet->update($validatedData);

        // 4. Update livrables (if any)
        if (isset($validatedData['livrable'])) {
            $livrableIds = []; // Keep track of existing livrables by their IDs
            foreach ($validatedData['livrable'] as $index => $livrable) {
                $livrableData = [
                    'titre' => $livrable,
                    'description' => $validatedData['livrable_description'][$index] ?? null,
                    'lien' => $validatedData['livrable_link'][$index] ?? null,
                    'nature_livrable_id' => $validatedData['livrable_nature'][$index],
                    'projet_id' => $projet->id,
                ];

                if (isset($validatedData['livrable_id'][$index])) {
                    // Update existing livrable
                    $livrableId = $validatedData['livrable_id'][$index];
                    $this->livrableRepository->update($livrableId, $livrableData);
                    $livrableIds[] = $livrableId; // Add to the list of existing IDs
                } else {
                    // Create new livrable
                    $newLivrable = $this->livrableRepository->create($livrableData);
                    $livrableIds[] = $newLivrable->id; // Add to the list of existing IDs
                }
            }
            // Delete any livrables that were not included in the update
            $projet->livrables()->whereNotIn('id', $livrableIds)->delete();
        }

        // 5. Update resources (if any)
        if (isset($validatedData['ressource_nom'])) {
            $ressourceIds = []; // Keep track of existing resources
            foreach ($validatedData['ressource_nom'] as $index => $ressource_nom) {
                $ressourceData = [
                    'nom' => $ressource_nom,
                    'description' => $validatedData['ressource_description'][$index] ?? null,
                    'lien' => $validatedData['ressource_lien'][$index] ?? null,
                    'projet_id' => $projet->id,
                ];

                if (isset($validatedData['ressource_id'][$index])) {
                    // Update existing resource
                    $ressourceId = $validatedData['ressource_id'][$index];
                    $this->resourceRepository->update($ressourceId, $ressourceData);
                    $ressourceIds[] = $ressourceId; // Add to the list of existing IDs
                } else {
                    // Create new resource
                    $newRessource = $this->resourceRepository->create($ressourceData);
                    $ressourceIds[] = $newRessource->id; // Add to the list of existing IDs
                }
            }
            // Delete any resources that were not included in the update
            $projet->resources()->whereNotIn('id', $ressourceIds)->delete();
        }

   // 6. Update TransfertCompetence records
   if (isset($validatedData['competences'])) {
    $transfertCompetenceIds = []; // Keep track of existing TransfertCompetence records

    foreach ($validatedData['competences'] as $competence_id) {
        // Get the appreciation ID directly from the request
        $appreciation_id = $request->input('competence_' . $competence_id . '_appreciation');

        $transfertCompetenceData = [
            'projet_id' => $projet->id,
            'competence_id' => $competence_id,
            'appreciation_id' => $appreciation_id,
        ];

        if (isset($validatedData['transfert_competence_id'][$competence_id])) {
            // Update existing TransfertCompetence
            $transfertCompetenceId = $validatedData['transfert_competence_id'][$competence_id];
            $this->transfercompetenceRepository->update($transfertCompetenceId, $transfertCompetenceData);
        } else {
            // Create new TransfertCompetence
            $newTransfertCompetence = $this->transfercompetenceRepository->create($transfertCompetenceData);
            $transfertCompetenceId = $newTransfertCompetence->id; // Assign the newly created ID
        }

        // Add to the list of existing or newly created IDs
        $transfertCompetenceIds[] = $transfertCompetenceId;

        // Update technologies associated with the TransfertCompetence
        if (isset($validatedData['technologie_ids'][$competence_id])) {
            $technologieIds = $validatedData['technologie_ids'][$competence_id];
            $transfertCompetence = $this->transfercompetenceRepository->find($transfertCompetenceId);
            // Use the `sync` method to update the technologies associated with the TransfertCompetence
            $transfertCompetence->technologies()->sync($technologieIds);
        } else {
            // If no technologies are selected, detach all associated technologies
            $transfertCompetence = $this->transfercompetenceRepository->find($transfertCompetenceId);
            $transfertCompetence->technologies()->detach();
        }
    }

    // Delete any TransfertCompetence records that were not included in the update
    $projet->transfertCompetences()->whereNotIn('id', $transfertCompetenceIds)->delete();
}
        // 7. Update apprentice records (RealisationProjets)
        if (isset($validatedData['apprenants'])) {
            foreach ($validatedData['apprenants'] as $apprenantId) {
                $realisationProjetData = [
                    'projet_id' => $projet->id,

                    'personne_id' => $apprenantId, // Assuming 'personne_id' is the apprenant ID field
                ];
                $this->projectRealisationRepository->create($realisationProjetData);
            }
        }

        // 8. Redirect with a success message
        return redirect()->route('projets.index')->with('success', 'Le projet a été mis à jour avec succès.');
    }


    public function destroy($id)
    {
        $this->projetRepository->destroy($id);
        return redirect()->route('projets.index')->with('success', 'Le projet a été supprimé avec succès.');
    }

    public function import(Request $request)
    {
        // Validate the file upload (ensure it's an Excel file)
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        // Import the Excel file
        try {
            Excel::import(new ProjetImport, $request->file('file'));

            // Redirect with success message
            return redirect()->route('projets.index')->with('success', 'Les projets ont été importés avec succès.');
        } catch (\Exception $e) {
            // Handle errors and provide feedback to the user
            return redirect()->route('projets.index')->with('error', 'Une erreur s\'est produite lors de l\'importation des projets. Veuillez vérifier votre fichier Excel.');
        }
    }

    public function export()
    {
        return Excel::download(new ProjetExport, 'projets.xlsx'); // Add 'return'
    }
}
