<?php

namespace Tests\Feature\pkg_competences;

use App\Models\pkg_competences\CategorieTechnologie;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use Tests\TestCase;

class CategorieTechnologieTest extends TestCase
{
    use DatabaseTransactions;

    protected $categorieTechnologie;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categorieTechnologie = CategorieTechnologie::create([
            'code' => 'TestCodeCategorie',
            'nom' => 'TestNomCategorie',
            'description' => 'TestDescriptionCategorie',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function test_create_categorie_technologie(): void
    {
        $data = [
            'code' => 'TestCode',
            'nom' => 'TestNom',
            'description' => 'TestDescription',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $categorieTechnologie = CategorieTechnologie::create($data);

        $this->assertDatabaseHas('categorie_technologies', ['id' => $categorieTechnologie->id]);
    }

    public function test_read_categorie_technologie(): void
    {
        $categorieTechnologie = CategorieTechnologie::find($this->categorieTechnologie->id);

        $this->assertNotNull($categorieTechnologie);
        $this->assertEquals($this->categorieTechnologie->id, $categorieTechnologie->id);
    }

    public function test_update_categorie_technologie(): void
    {
        $newName = 'UpdatedNom';
        $this->categorieTechnologie->update(['nom' => $newName, 'updated_at' => Carbon::now()]);

        $this->assertEquals($newName, $this->categorieTechnologie->fresh()->nom);
    }

    public function test_delete_categorie_technologie(): void
    {
        $this->categorieTechnologie->delete();

        $this->assertDatabaseMissing('categorie_technologies', ['id' => $this->categorieTechnologie->id]);
    }

    
}
