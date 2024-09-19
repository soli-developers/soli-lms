<?php

namespace App\Http\Controllers\pkg_suivi;

use App\Http\Controllers\AppBaseController;
use App\Repositories\pkg_suivi\SuiviCompetenceRepository;
use Illuminate\Support\Facades\Auth;

class SuiviCompetencesController extends AppBaseController
{
    protected $suiviCompetenceRepository;

    public function __construct(SuiviCompetenceRepository $suiviCompetenceRepository)
    {
        $this->suiviCompetenceRepository = $suiviCompetenceRepository;
    }

    public function index()
    {
          // Get the ID of the authenticated person
          $personneId = Auth::id();

          // Fetch apprenants competences data
          $data = $this->suiviCompetenceRepository->getApprenantsCompetences($personneId);
  
          return view('pkg_suivi.apprenantCompetences', $data);
    }
    
    
}
