<?php

namespace App\Http\Controllers\pkg_realisation_projets;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\pkg_realisation_projets\projectRealisationRepository;
use App\Models\pkg_realisation_projets\RealisationProjet;
use App\Models\pkg_competences\Competence; // Assuming you have a Skill model
use App\Models\pkg_creation_projets\Projet; // Assuming you have a Project model
use App\Models\pkg_rh\Personne; // Assuming you have a Learner model
use App\Models\pkg_realisation_projets\EtatRealisationProjet;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\pkg_realisation_projets\RealisationProjetRequest;
use App\Models\pkg_validations\Validation;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\pkg_creation_projets\ProjetRequest;
use App\Http\Requests\pkg_creation_projets\ProjetStoreRequest;
use App\Models\pkg_competences\Appreciation;
use App\Models\pkg_competences\Technologie;
use App\Models\pkg_creation_projets\NatureLivrable;
use App\Models\pkg_rh\Apprenant;
use App\Repositories\pkg_competences\CompetenceRepository;
use App\Repositories\Pkg_competences\TechnologieRepository;
use App\Repositories\pkg_creation_projets\LivrableRepository;
use App\Repositories\pkg_creation_projets\ProjetRepository;
use App\Repositories\pkg_creation_projets\ResourceRepository;
use App\Repositories\pkg_creation_projets\TechnologieCompetenceRepository;
use App\Repositories\pkg_creation_projets\TransfertCompetenceRepository;
use App\Repositories\pkg_realisation_projets\LivrableRealisationRepository;
use App\Repositories\pkg_rh\ApprenantRepository;
use App\Models\pkg_realisation_projets\LivrableRealisation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class Apprenants extends Controller
{
    protected $projectRealisationRepository;
    protected $projetRepository;
    protected $livrableRepository;
    protected $resourceRepository;
    protected $competenceRepository;
    protected $technologieRepository;
    protected $apprenantRepository;
    protected $transfercompetenceRepository;
    protected $technologiecompetenceRepository;
    protected $LivrableRealisationRepository;

    public function __construct(
        ProjetRepository $projetRepository,
        LivrableRepository $livrableRepository,
        ResourceRepository $resourceRepository,
        CompetenceRepository $competenceRepository,
        TechnologieRepository $technologieRepository,
        ApprenantRepository $apprenantRepository,
        TransfertCompetenceRepository $transfercompetenceRepository,
        TechnologieCompetenceRepository $technologiecompetenceRepository,
        LivrableRealisationRepository $LivrableRealisationRepository,


        ProjectRealisationRepository $projectRealisationRepository,
    ) {
        $this->projectRealisationRepository = $projectRealisationRepository;
        $this->projetRepository = $projetRepository;
        $this->livrableRepository = $livrableRepository;
        $this->resourceRepository = $resourceRepository;
        $this->competenceRepository = $competenceRepository;
        $this->technologieRepository = $technologieRepository;
        $this->apprenantRepository = $apprenantRepository;
        $this->transfercompetenceRepository = $transfercompetenceRepository;
        $this->technologiecompetenceRepository = $technologiecompetenceRepository;
        $this->LivrableRealisationRepository = $LivrableRealisationRepository;
    }

    public function index(Request $request)
    {
        $userGroupeId = Auth::user()->id;
        $Competences = Competence::all();
        $projects = Projet::all();
        $EtatRealisationProjet = EtatRealisationProjet::all();
        $Personnes = Personne::where('type', 'apprenant')
            ->where('groupe_id', $userGroupeId)
            ->get();

        // dd($request->get('searchValue'));

        if ($request->get('competenceId') != null) {
            $competenceId = $request->get('competenceId');

            $realisationProjets = $this->projectRealisationRepository->Filter($competenceId, $userGroupeId);
            return view('pkg_realisation_projets.Apprenant.table', compact('realisationProjets', 'competenceId'))->render();
        }

        if ($request->get('searchValue') != null) {
            // dd($request->get('competenceId'));
            $searchValue = $request->get('searchValue');

            $realisationProjets = $this->projectRealisationRepository->Search($searchValue);
            return view('pkg_realisation_projets.Apprenant.table', compact('realisationProjets', 'searchValue'))->render();
        }

        $realisationProjets = $this->projectRealisationRepository->with([
            'projet.transfertCompetences.competence',
            'competence',
            'personne',
            'etatRealisationProjet',
            'validation'
        ])
            ->where('personne_id', $userGroupeId)
            ->paginate(2);




        return view('pkg_realisation_projets.Apprenant.index', compact('realisationProjets', 'Competences', 'projects', 'Personnes', 'EtatRealisationProjet'));
    }


    public function create(Request $request)
    {
        // $realisationProjets = RealisationProjet::with('realisation_projet_id')->all();
        // dd($realisationProjets);
        return view('pkg_realisation_projets.Apprenant.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|string',
            'lien' => 'required|string',
        ]);


        $serverBag = $request->server;

        // Retrieve the "HTTP_REFERER" value
        $httpReferer = $serverBag->get('HTTP_REFERER');

        // Use the "HTTP_REFERER" value
        $parts = explode('create?', $httpReferer);

        if (isset($parts[1])) {
            $partsTwo = explode('=', $parts[1]);
        }

        $this->LivrableRealisationRepository->create(
            [
                'nom' => $request->nom,
                'lien' => $request->lien,
                'description' => $request->description,
                'realisation_projet_id' => reset($partsTwo)
            ]
        );
        return redirect()->route('apprenantRealisations.index')->with('success', 'Livrable ajouté avec succès.');
        // } catch (LivrableAlreadyExistException $e) {
        //     return back()->withInput()->withErrors(['livrable_exists' => $e->getMessage()]);
        // } catch (\Exception $e) {
        //     return abort(500);
        // }
    }


    public function show($id)
    {
        $realisationProjet = $this->projectRealisationRepository->find($id);
        $TransfertCompetence = $this->transfercompetenceRepository->find($id);

        $competence_id = $TransfertCompetence->pluck('competence_id');


        $projects = Projet::all();
        $projectIds = [1,]; // Multiple project IDs
        // $pjctid = TransfertCompetence::whereIn('projet_id', $projectIds)->pluck('competence_id');

        $TransfertCompetenceid = $TransfertCompetence->competence_id;

        // dd($TransfertCompetenceid);


        $Competences = Competence::where('id', $TransfertCompetenceid)->pluck('nom');
        // dd($Competence);

        $EtatRealisationProjet = EtatRealisationProjet::all();
        $userGroupeId = Auth::user()->id;
        // dd($Competence);
        $realisationProjet = $this->projectRealisationRepository->find($id);
        return view('pkg_realisation_projets.Apprenant.show', compact('realisationProjet', 'Competences'));




        // dd($realisationProjet );
        // return view('pkg_realisation_projets.Apprenant.show', compact('realisationProjet','projects','projectCompetenceId','Competences','EtatRealisationProjet','userGroupeId'));
    }

    public function edit($id)
    {
        $realisationProjet = $this->projectRealisationRepository->find($id);
        return view('pkg_realisation_projets.Apprenant.edit', compact('realisationProjet'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validated();
        $this->projectRealisationRepository->update($id, $validatedData);
        return redirect()->route('realisationProjets.index')->with('success', 'Realisation Projet updated successfully.');
    }

    public function destroy($id)
    {
        $this->projectRealisationRepository->destroy($id);
        return redirect()->route('realisationProjets.index')->with('success', 'Realisation Projet deleted successfully.');
    }
}