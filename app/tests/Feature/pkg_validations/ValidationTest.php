<?php

namespace Tests\Feature\pkg_validations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\pkg_validations\ValidationsRepository;
use App\Models\pkg_validations\Validation;
use App\Models\pkg_validations\Message;
use App\Exceptions\pkg_validations\ValidationAlreadyExistException;

class ValidationTest extends TestCase
{
    use DatabaseTransactions;

    protected $validationsRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validationsRepository = new ValidationsRepository();
    }

    /**
     * Test creating a validation with an associated message.
     *
     * @return void
     */
    public function test_Create_With_Message()
    {
        $data = [
            'note' => 12,
            'transfert_competence_id' => 10,
            'appreciation_id' => 3,
            'realisation_projet_id' => 6,
            'message_title' => 'Test hutle',
            'message_description' => 'Test Description'
        ];

        $validation = $this->validationsRepository->createWithMessage($data);
        $this->assertDatabaseHas('validations', [
            'note' => $data['note'],
            'transfert_competence_id' => $data['transfert_competence_id'],
            'appreciation_id' => $data['appreciation_id'],
            'realisation_projet_id' => $data['realisation_projet_id'],
        ]);

        $this->assertDatabaseHas('messages', [
            'titre' => $data['message_title'],
            'description' => $data['message_description'],
            'validation_id' => $validation->id
        ]);
    }

   
   
}
