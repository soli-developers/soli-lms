<?php

namespace Tests\Feature\pkg_competences;

use App\Models\pkg_competences\NiveauCompetence;
use App\Models\pkg_competences\Competence;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use Tests\TestCase;

class NiveauCompetenceTest extends TestCase
{
    use DatabaseTransactions;

    protected $competence;
    protected $niveauCompetence;

    protected function setUp(): void
    {
        parent::setUp();
        $this->competence = Competence::create([
            'code' => 'TestCodeCompetence',
            'nom' => 'TestNomCompetence',
            'description' => 'TestDescriptionCompetence',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function test_create_niveau_competence(): void
    {
        $data = [
            'nom' => 'TestNiveau',
            'description' => 'TestDescription',
            'competence_id' => $this->competence->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->niveauCompetence = NiveauCompetence::create($data);

        $this->assertDatabaseHas('niveau_competences', [
            'id' => $this->niveauCompetence->id,
        ]);
    }

    public function test_read_niveau_competence(): void
    {
        $data = [
            'nom' => 'TestNiveau',
            'description' => 'TestDescription',
            'competence_id' => $this->competence->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->niveauCompetence = NiveauCompetence::create($data);

        $foundNiveauCompetence = NiveauCompetence::find($this->niveauCompetence->id);

        $this->assertNotNull($foundNiveauCompetence);
        $this->assertEquals($this->niveauCompetence->id, $foundNiveauCompetence->id);
    }

    public function test_update_niveau_competence(): void
    {
        $data = [
            'nom' => 'TestNiveau',
            'description' => 'TestDescription',
            'competence_id' => $this->competence->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->niveauCompetence = NiveauCompetence::create($data);

        $newName = 'UpdatedNiveau';
        $this->niveauCompetence->update([
            'nom' => $newName,
            'updated_at' => Carbon::now(),
        ]);

        $this->assertEquals($newName, $this->niveauCompetence->fresh()->nom);
    }

    public function test_delete_niveau_competence(): void
    {
        $data = [
            'nom' => 'TestNiveau',
            'description' => 'TestDescription',
            'competence_id' => $this->competence->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->niveauCompetence = NiveauCompetence::create($data);

        $this->niveauCompetence->delete();

        $this->assertDatabaseMissing('niveau_competences', [
            'id' => $this->niveauCompetence->id,
        ]);
    }

    public function test_filter_niveau_competence_by_competence_id(): void
    {
        $data = [
            'nom' => 'TestNiveau',
            'description' => 'TestDescription',
            'competence_id' => $this->competence->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        NiveauCompetence::create($data);

        $filteredNiveauCompetences = NiveauCompetence::where('competence_id', $this->competence->id)->get();

        $this->assertNotEmpty($filteredNiveauCompetences);
        $this->assertEquals($this->competence->id, $filteredNiveauCompetences->first()->competence_id);
    }
}
