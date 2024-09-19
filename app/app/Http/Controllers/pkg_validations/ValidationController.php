<?php

namespace App\Http\Controllers\pkg_validations;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_validations\ValidationRequest;
use App\Repositories\pkg_creation_projets\TransfertCompetenceRepository;
use App\Repositories\pkg_realisation_projets\EtatRealisationProjetRepository;
use App\Repositories\pkg_realisation_projets\projectRealisationRepository;
use Illuminate\Http\Request;
use App\Repositories\pkg_validations\ValidationsRepository;
use App\Models\pkg_validations\Validation;
use App\Models\pkg_realisation_projets\RealisationProjet;
use App\Models\pkg_realisation_projets\LivrableRealisation;
use App\Models\pkg_creation_projets\TransfertCompetence;
use App\Models\pkg_creation_projets\Projet;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_competences\Appreciation;
use App\Models\pkg_validations\Message;
use App\Repositories\pkg_creation_projets\ProjetRepository;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;




class ValidationController extends Controller
{
    protected $validationsRepository;
    protected $projectRealisationRepository;

    public function __construct(
        ValidationsRepository $validationsRepository,
        projectRealisationRepository $projectRealisationRepository,
        )
    {
        $this->validationsRepository = $validationsRepository;
        $this->projectRealisationRepository = $projectRealisationRepository;
    }

    public function index()
    {
        $RealisationProjet = RealisationProjet::all();

        $validations = Validation::all(); // You might want to use repository method if pagination or specific filtering is needed
        return view('pkg_validations.index', compact('validations','RealisationProjet'));
    }
    public function show($realisationProjetId)
    {
        // Find the RealisationProjet by its ID
        $realisation = RealisationProjet::findOrFail($realisationProjetId);

        // Get all competencies for the project
        $competences = $realisation->projet->transfertCompetences()
            ->with(['competence', 'appreciation', 'validations' => function ($query) use ($realisationProjetId) {
                $query->where('realisation_projet_id', $realisationProjetId);
            }])
            ->get();

        // Get all possible appreciations
        $appreciations = Appreciation::all();

        // Fetch messages associated with each competence
        $messages = Message::whereHas('validation', function ($query) use ($realisationProjetId) {
            $query->where('realisation_projet_id', $realisationProjetId);
        })->get();

        // Group messages by competence ID for easy access in the view
        $messagesByCompetence = [];
        foreach ($messages as $message) {
            $messagesByCompetence[$message->validation->transfertCompetence->id][] = $message;
        }

        // Fetch and format notes from validations
        $notesByCompetence = [];
        foreach ($competences as $competence) {
            $validation = $competence->validations->first(); // Get the first validation (assuming only one per competence)
            if ($validation) {
                $notesByCompetence[$competence->id] = $validation->note;
                $appreciationId = $validation->appreciation_id;
                $competence->appreciation_id = $appreciationId; // Update the appreciation ID for the competence
            }
        }

        return view('pkg_validations.index', compact(
            'realisation',
            'competences',
            'appreciations',
            'messagesByCompetence',
            'notesByCompetence' // Pass the notes to the view
        ));
    }

    public function store(ValidationRequest $request)
    {
        $validatedData = $request->validated(); // This will contain the validated data

        if($validatedData['validations'][$validatedData['realisation_projet_id']]['note'] > 9 && $validatedData['validations'][$validatedData['realisation_projet_id']]['appreciation_id'] == 3){
            return back()->with('error', 'la note dôit être  entre  0 et 9 pour cette appreciation ');
        }else  if(($validatedData['validations'][$validatedData['realisation_projet_id']]['note'] < 10 ||$validatedData['validations'][$validatedData['realisation_projet_id']]['note'] > 12 )&& $validatedData['validations'][$validatedData['realisation_projet_id']]['appreciation_id'] == 2){
            return back()->with('error', 'la note dôit être  entre  10 et 12 pour cette appreciation ');
        }else if (($validatedData['validations'][$validatedData['realisation_projet_id']]['note'] < 13 ||$validatedData['validations'][$validatedData['realisation_projet_id']]['note'] > 20) && $validatedData['validations'][$validatedData['realisation_projet_id']]['appreciation_id'] == 1){
            return back()->with('error', 'la note dôit être  entre 13 et 20 pour cette appreciation '); 
        }


        $realisationProjetId = $validatedData['realisation_projet_id'];

        // Process validations for each competence
        foreach ($validatedData['validations'] as $competenceId => $validationData) {
            // Find existing validation (if any)
            $validation = Validation::where('realisation_projet_id', $realisationProjetId)
                                    ->where('transfert_competence_id', $competenceId)
                                    ->first();

            // Update or create the validation
            if ($validation) {
                $validation->update([
                    'appreciation_id' => $validationData['appreciation_id'],
                    'note' => $validationData['note'],
                ]);
            } else {
                $validation = Validation::create([
                    'realisation_projet_id' => $realisationProjetId,
                    'transfert_competence_id' => $competenceId,
                    'appreciation_id' => $validationData['appreciation_id'],
                    'note' => $validationData['note'],
                ]);
            }

            // Update or create the associated message
            $message = Message::where('validation_id', $validation->id)->first();
            if ($message) {
                $message->update([
                    'titre' => $validationData['titre'],
                    'description' => $validationData['description'],
                ]);
            } else {
                Message::create([
                    'validation_id' => $validation->id,
                    'titre' => $validationData['titre'],
                    'description' => $validationData['description'],
                ]);
            }
        }

        return redirect()
        ->route('realisationProjets.index', ['realisationProjetId' => $realisationProjetId])->with('success', 'Le projet a été validé avec succès!');
    }

    public function create()
    {
        return view('pkg_validations.create');
    }


    public function detail($realisationProjetId)
    {
 // Find the RealisationProjet by its ID
 $realisation = RealisationProjet::findOrFail($realisationProjetId);

 // Get all competencies for the project
 $competences = $realisation->projet->transfertCompetences()
     ->with(['competence', 'appreciation', 'validations' => function ($query) use ($realisationProjetId) {
         $query->where('realisation_projet_id', $realisationProjetId);
     }])
     ->get();

 // Get all possible appreciations
 $appreciations = Appreciation::all();

 // Fetch messages associated with each competence
 $messages = Message::whereHas('validation', function ($query) use ($realisationProjetId) {
     $query->where('realisation_projet_id', $realisationProjetId);
 })->get();

 // Group messages by competence ID for easy access in the view
 $messagesByCompetence = [];
 foreach ($messages as $message) {
     $messagesByCompetence[$message->validation->transfertCompetence->id][] = $message;
 }

 // Fetch and format notes from validations
 $notesByCompetence = [];
 foreach ($competences as $competence) {
     $validation = $competence->validations->first(); // Get the first validation (assuming only one per competence)
     if ($validation) {
         $notesByCompetence[$competence->id] = $validation->note;
         $appreciationId = $validation->appreciation_id;
         $competence->appreciation_id = $appreciationId; // Update the appreciation ID for the competence
     }
 }

 return view('pkg_validations.validation.show', compact(
     'realisation',
     'competences',
     'appreciations',
     'messagesByCompetence',
     'notesByCompetence' // Pass the notes to the view
 ));     
    }
}
