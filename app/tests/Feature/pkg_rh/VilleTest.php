<?php

namespace Tests\Feature\GestionRH;

use App\Models\pkg_rh\Ville;
use App\Repositories\GestionRH\GestionVilleRepository;
use App\Repositories\pkg_rh\VilleRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VilleTest extends TestCase
{

    use DatabaseTransactions;
    protected $VilleRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->VilleRepository = new VilleRepository(new Ville());
    }
    
    public function test_create_ville()
    {
        $create_ville = $this->VilleRepository->create([
            'nom' => 'Casablancla',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        $this->assertNotNull($create_ville);
    }

    public function test_update_ville()
    {
        $update_ville = $this->VilleRepository->update(3, [
            'nom' => 'Tanger',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        $this->assertNotNull($update_ville);
    }

    public function test_delete_ville()
    {
        $delete_ville = $this->VilleRepository->destroy(2);
        $this->assertNotNull($delete_ville);
    }
}
