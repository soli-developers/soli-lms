<?php

namespace Tests\Feature\pkg_competences;

use App\Models\pkg_competences\Competence;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use Tests\TestCase;

class CompetencesTest extends TestCase
{
    use DatabaseTransactions;

    protected $competence;

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

    public function test_create_competence(): void
    {
        $data = [
            'code' => 'TestCode',
            'nom' => 'TestNom',
            'description' => 'TestDescription',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $competence = Competence::create($data);

        $this->assertDatabaseHas('competences', ['id' => $competence->id]);
    }

    public function test_read_competence(): void
    {
        $competence = Competence::find($this->competence->id);

        $this->assertNotNull($competence);
        $this->assertEquals($this->competence->id, $competence->id);
    }

    public function test_update_competence(): void
    {
        $newName = 'UpdatedNom';
        $this->competence->update(['nom' => $newName, 'updated_at' => Carbon::now()]);

        $this->assertEquals($newName, $this->competence->fresh()->nom);
    }

    public function test_delete_competence(): void
    {
        $this->competence->delete();

        $this->assertDatabaseMissing('competences', ['id' => $this->competence->id]);
    }

    public function test_filter_competence_by_code(): void
    {
        $filteredCompetences = Competence::where('code', 'TestCodeCompetence')->get();

        $this->assertNotEmpty($filteredCompetences);
        $this->assertEquals('TestCodeCompetence', $filteredCompetences->first()->code);
    }
}
