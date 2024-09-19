<?php

namespace Tests\Feature\GestionRH;

use App\Models\pkg_rh\Apprenant;
use App\Models\User;
use App\Repositories\GestionRH\GestionApprenantRepository;
use App\Repositories\pkg_rh\ApprenantRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApprenantTest extends TestCase
{

    use DatabaseTransactions;

    protected $ApprenantRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->ApprenantRepository = new ApprenantRepository(new Apprenant());
    }
    
    public function test_create_Apprenant()
    {
        $user = User::create([
            'email' => 'emaiUIUYUDIlRTSR@example.com',
            'password' => 'qfsfhpisefopsjfpos',
            
        ]);
        $create_Apprenant = $this->ApprenantRepository->create([
            'nom' => "GraiQQQn",
            'prenom' => "RedQQQa",
            'nom_arab' => "Grain",
            'prenom_arab' => "Reda",
            'date_naissance' => "1999-03-13",
            'tele_num' => "039847394343",
            'rue' => "Tanger",
            'ville_id' => 3,
            'cin' => "cin",
            'groupe_id' => 1,
            'cne' => "cne",
            'niveau_scolaire_id' => 1,
            'lieu_naissance_id' => 3,
            '_token' => 'fhskjfhsdkjfhskldjfhsdkfhoise',
            'user_id' => $user->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        $this->assertNotNull($create_Apprenant);
    }

    public function test_update_Apprenant()
    {
        $update_Apprenant = $this->ApprenantRepository->update(7,[
            'nom' => "Grain",
            'prenom' => "Reda"
        ]);
        $this->assertNotNull($update_Apprenant);
    }

    public function test_delete_Apprenant()
    {
        $delete_Apprenant = $this->ApprenantRepository->destroy(2);
        $this->assertNotNull($delete_Apprenant);
    }
}
