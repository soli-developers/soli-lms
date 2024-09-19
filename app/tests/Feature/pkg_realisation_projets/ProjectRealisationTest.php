<?php

namespace Tests\Feature\pkg_realisation_projets;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\pkg_realisation_projets\projectRealisationRepository;
use App\Models\pkg_realisation_projets\RealisationProjet;
use Tests\TestCase;
use App\Exceptions\pkg_realisation_projets\ProjectRealisationAlreadyExistException;


class ProjectRealisationTest extends TestCase
{
    use DatabaseTransactions;

    protected $realisationProjetRepository;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->realisationProjetRepository = new projectRealisationRepository(new RealisationProjet);
        $this->user = User::factory()->create();
    }

    public function test_paginate()
    {

        $realisationProjets = $this->realisationProjetRepository->paginate();
        $this->assertNotNull($realisationProjets);
    }

    public function test_create()
    {
        $this->actingAs($this->user);
        $realisationProjetData = [
            // 'name' => 'Project Realisation Test',
            // 'description' => 'Description for Project Realisation',
            'date_debut_realisation' => '2024-05-27',
            'date_fin_realisation' => '2024-06-27',
            'projet_id' => 1, // Update with the appropriate project ID
            'etat_realisation_projet_id' => 1, // Update with the appropriate state ID
            'personne_id' => null, // Update with the appropriate person ID if needed
        ];
        $realisationProjet = $this->realisationProjetRepository->create($realisationProjetData);
        $this->assertEquals($realisationProjetData['date_debut_realisation'], $realisationProjet->date_debut_realisation);
    }

    // public function test_create_project_realisation_already_exist()
    // {
    //     $this->actingAs($this->user);
    
    //     $realisationProjet = RealisationProjet::factory()->create();
    //     $realisationProjetData = [
    //         'date_debut_realisation' => '2024-05-27',
    //         'date_fin_realisation' => '2024-06-27',
    //         'projet_id' => 1, // Update with a valid project ID that exists in the `projets` table
    //         'etat_realisation_projet_id' => 1, // Update with the appropriate state ID
    //         'personne_id' => 1, // Update with the appropriate person ID if needed
    //     ];
    
    //     try {
    //         $realisationProjet = $this->realisationProjetRepository->create($realisationProjetData);
    //         $this->fail('Expected ProjectRealisationAlreadyExistException was not thrown');
    //     } catch (ProjectRealisationAlreadyExistException $e) {
    //         $this->assertEquals(__('pkg_realisation_projets/message.createProjectRealisationException'), $e->getMessage());
    //     } catch (\Exception $e) {
    //         $this->fail('Unexpected exception was thrown: ' . $e->getMessage());
    //     }
    // }

    public function test_update()
    {
        $this->actingAs($this->user);
        $data = [
            'date_debut_realisation' => '2024-05-30',
            'date_fin_realisation' => '2024-06-01',
            'projet_id' => 1, // Update with the appropriate project ID
            'etat_realisation_projet_id' => 1, // Update with the appropriate state ID
            'personne_id' => null, // Update with the appropriate person ID if needed
        ];
        $realisationProjet = $this->realisationProjetRepository->create($data);
        $realisationProjetData = [
            'date_debut_realisation' => '2024-05-27',
            'date_fin_realisation' => '2024-06-27',
            'projet_id' => 1, // Update with the appropriate project ID
            'etat_realisation_projet_id' => 1, // Update with the appropriate state ID
            'personne_id' => null, // Update with the appropriate person ID if needed
        ];
        // dd($realisationProjet);
        $this->realisationProjetRepository->update($realisationProjet->id, $realisationProjetData);
        $this->assertDatabaseHas('realisation_projets', $realisationProjetData);
    }

    // public function test_delete_project_realisation()
    // {
    //     $this->actingAs($this->user);
    //     $realisationProjet = RealisationProjet::factory()->create();
    //     $this->realisationProjetRepository->destroy($realisationProjet->id);
    //     $this->assertDatabaseMissing('realisation_projets', ['id' => $realisationProjet->id]);
    // }

    // public function test_project_realisation_search()
    // {
    //     $this->actingAs($this->user);
    //     $realisationProjetData = [
    //         'date_debut_realisation' => '2024-05-27',
    //         'date_fin_realisation' => '2024-06-27',
    //         'projet_id' => 1, // Update with the appropriate project ID
    //         'etat_realisation_projet_id' => 1, // Update with the appropriate state ID
    //         'personne_id' => null, // Update with the appropriate person ID if needed
    //     ];
    //     $this->realisationProjetRepository->create($realisationProjetData);
    //     $searchValue = 'search test';
    //     $searchResults = $this->RealisationProjetRepository->searchData($searchValue);
    //     $this->assertTrue($searchResults->contains('name', $searchValue));
    // }
}