<?php

namespace Tests\Feature\pkg_creation_projets;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\pkg_creation_projets\Projet;
use App\Repositories\pkg_creation_projets\ProjetRepository;
use App\Repositories\pkg_rh\FormateurRepository;
use App\Models\pkg_rh\Formateur;
use App\Models\User;
use App\Models\pkg_rh\Ville;
use App\Models\pkg_rh\Specialite;
use App\Models\pkg_rh\Groupe;
use App\Models\pkg_rh\LieuNaissance;
use Carbon\Carbon;

class ProjetRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $projetRepo;
    protected $user;
    protected $formateurRepo;
    protected $formateur;

    protected function setUp(): void
    {
        parent::setUp();
        $this->projetRepo = new ProjetRepository();
        $this->formateurRepo = new FormateurRepository(new Formateur());

        // Create a user
        $this->user = User::create([
            'email' => 'hussein@example.com',
            'password' => bcrypt('password'),  // bcrypt the password
        ]);

        // Create necessary data for Ville, Specialite, Groupe, and LieuNaissance
        $this->createTestData();

        // Create a Formateur
        $this->formateur = $this->formateurRepo->create([
            'nom' => 'bouik',
            'prenom' => 'hussein',
            'nom_arab' => 'Grain',
            'prenom_arab' => 'Reda',
            'date_naissance' => '1999-03-13',
            'tele_num' => '039847394343',
            'rue' => 'Tanger',
            'ville_id' => 1, // Use the created Ville ID
            'cin' => 'cin',
            'groupe_id' => 1, // Use the created Groupe ID
            'cne' => 'cne',
            'specialite_id' => 1, // Use the created Specialite ID
            'lieu_naissance_id' => 1, // Use the created LieuNaissance ID
            '_token' => 'fhskjfhsdkjfhskldjfhsdkfhoise',
            'user_id' => $this->user->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        // Check if formateur is created successfully
    }
    /**
     * Creates test data for Ville, Specialite, Groupe, and LieuNaissance.
     */
    protected function createTestData(): void
    {
        // Create a Ville
        Ville::create(['nom' => 'Tanger']);

        // Create a Specialite
        Specialite::create(['nom' => 'Informatique']);

        // Create a Groupe
        Groupe::create(['nom' => 'Développement Web', 'description' => 'Groupe de développement web']);

    }

    /**
     * Test creating a projet.
     */
    public function testCreateProjet(): void
    {
        $projetData = [
            'titre' => 'Test Project',
            'description' => 'This is a test project',
            'travailAFaire' => 'Original Work',
            'critereDeTravail' => 'Original Criteria',
            'dateDebut' => '2024-06-01',
            'dateFin' => '2024-12-31',
            'formateur_id' => $this->formateur->id,
        ];

        $createdProjet = $this->projetRepo->create($projetData);

        $this->assertDatabaseHas('projets', $projetData); // Assert the projet is in the database
        $this->assertEquals($this->formateur->id, $createdProjet->formateur_id);
    }

    /**
     * Test finding a projet.
     */
    public function testFindProjet(): void
    {
        $projet = Projet::create([
            'titre' => 'Test Project',
            'description' => 'This is a test project',
            'travailAFaire' => 'Original Work',
            'critereDeTravail' => 'Original Criteria',
            'dateDebut' => '2024-06-01',
            'dateFin' => '2024-12-31',
            'formateur_id' => $this->formateur->id,
            // Add other fields as needed...
        ]);

        $foundProjet = $this->projetRepo->find($projet->id);

        $this->assertEquals($projet->titre, $foundProjet->titre);
        $this->assertEquals($this->formateur->id, $foundProjet->formateur_id);
    }

    /**
     * Test updating a projet.
     */
    public function testUpdateProjet(): void
    {
        $projet = Projet::create([
            'titre' => 'Test Project',
            'description' => 'This is a test project',
            'travailAFaire' => 'Original Work',
            'critereDeTravail' => 'Original Criteria',
            'dateDebut' => '2024-06-01',
            'dateFin' => '2024-12-31',
            'formateur_id' => $this->formateur->id,
            // Add other fields as needed...
        ]);

        $updateData = [
            'titre' => 'Updated Title',
        ];

        $updateResult = $this->projetRepo->update($projet->id, $updateData);

        $this->assertTrue($updateResult);
        $this->assertDatabaseHas('projets', $updateData); // Assert the update in the database
        $this->assertEquals($this->formateur->id, $projet->formateur_id);
    }

    /**
     * Test deleting a projet.
     */
    public function testDeleteProjet(): void
    {
        $projet = Projet::create([
            'titre' => 'delete Project',
            'description' => 'This is a test project',
            'travailAFaire' => 'Original Work',
            'critereDeTravail' => 'Original Criteria',
            'dateDebut' => '2024-06-01',
            'dateFin' => '2024-12-31',
            'formateur_id' => $this->formateur->id,
            // Add other fields as needed...
        ]);

        $deleteResult = $this->projetRepo->destroy($projet->id);

        $this->assertTrue($deleteResult);
        $this->assertDatabaseMissing('projets', ['id' => $projet->id]); // Assert it's deleted
    }
}
