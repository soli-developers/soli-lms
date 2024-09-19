<?php

namespace Tests\Feature\GestionRH;

use App\Models\pkg_rh\Formateur;
use App\Models\User;
use App\Repositories\GestionRH\GestionFormateurRepository;
use App\Repositories\pkg_rh\FormateurRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormateurTest extends TestCase
{

    use DatabaseTransactions;

    protected $FormateurRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->FormateurRepository = new FormateurRepository(new Formateur());
    }
    
    public function test_create_Formateur()
    {
        $user = User::create([
            'email' => 'emaiUIUYUDIlRTSR@example.com',
            'password' => 'qfsfhpisefopsjfpos',
            
        ]);
        $create_Formateur = $this->FormateurRepository->create([
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
            'specialite_id' => 1,
            'lieu_naissance_id' => 3,
            '_token' => 'fhskjfhsdkjfhskldjfhsdkfhoise',
            'user_id' => $user->id,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        $this->assertNotNull($create_Formateur);
    }

    public function test_update_Formateur()
    {
        $update_Formateur = $this->FormateurRepository->update(9,[
            'nom' => "Grain",
            'prenom' => "Reda"
        ]);
        $this->assertNotNull($update_Formateur);
    }

    public function test_delete_Formateur()
    {
        $delete_Formateur = $this->FormateurRepository->destroy(2);
        $this->assertNotNull($delete_Formateur);
    }
}
