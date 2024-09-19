<?php


namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\pkg_rh\Personne;
use App\Models\pkg_rh\Formateur;
use App\Models\pkg_competences\Competence;
use App\Models\pkg_validations\Validation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\pkg_realisation_projets\RealisationProjet;
use App\Models\pkg_rh\Apprenant;
use App\Repositories\pkg_suivi\SuiviCompetenceRepository;

class SuiviCompetenceTest extends TestCase
{
    use RefreshDatabase;

    // public function testGetApprenantsCompetences()
    // {
    //     $groupeId = 1;

    //     // Create competences
    //     $competence1 = Competence::create(['nom' => 'Competence 1','code' => 'code 1','description' => 'description 1']);
    //     $competence2 = Competence::create(['nom' => 'Competence 2','code' => 'code 2','description' => 'description 2']);

    //     // Create a person (teacher) to pass as personneId
    //     // $personne = Formateur::create([
    //     //     'nom' => 'Teacher',
    //     //     'prenom' => 'Test',
    //     //     'groupe_id' => $groupeId,
    //     //     'type' => 'teacher'
    //     // ]);

    //     // Create apprenants and their projects and validations
    //     $apprenant1 = Apprenant::create([
    //         'nom' => 'Apprenant 1',
    //         'groupe_id' => $groupeId,
    //         'type' => 'apprenant'
    //     ]);

    //     $apprenant2 = Apprenant::create([
    //         'nom' => 'Apprenant 2',
    //         'groupe_id' => $groupeId,
    //         'type' => 'apprenant'
    //     ]);

    //     $realisationProjet1 = RealisationProjet::create([
    //         'personne_id' => $apprenant1->id,
    //         'date_debut_realisation' => '2023-01-01',
    //         'date_fin_realisation' => '2023-12-31',
    //         'etat_realisation_projet_id' => 1
    //     ]);

    //     $realisationProjet2 = RealisationProjet::create([
    //         'personne_id' => $apprenant2->id,
    //         'date_debut_realisation' => '2023-02-01',
    //         'date_fin_realisation' => '2023-12-31',
    //         'etat_realisation_projet_id' => 2
    //     ]);

    //     Validation::create([
    //         'realisation_projet_id' => $realisationProjet1->id,
    //         'transfert_competence_id' => $competence1->id,
    //         'appreciation_id' => 1 // Assume this is the id for the appreciation
    //     ]);

    //     Validation::create([
    //         'realisation_projet_id' => $realisationProjet2->id,
    //         'transfert_competence_id' => $competence2->id,
    //         'appreciation_id' => 2 // Assume this is the id for the appreciation
    //     ]);

    //     // Create the repository
    //     $repository = new SuiviCompetenceRepository();

    //     // Call the method
    //     $result = $repository->getApprenantsCompetences($personne->id);

    //     // Assert the structure of the result
    //     $this->assertArrayHasKey('results', $result);
    //     $this->assertArrayHasKey('competences', $result);
    //     $this->assertArrayHasKey('validations', $result);

    //     // Assert that the results contain the apprenants
    //     $this->assertNotEmpty($result['results']);
    //     $this->assertCount(2, $result['results']);

    //     // Assert that the competences are included
    //     $this->assertNotEmpty($result['competences']);
    //     $this->assertCount(2, $result['competences']);
    // }
}
