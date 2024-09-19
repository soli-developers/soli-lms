<?php

namespace App\Exceptions\pkg_competences;

use App\Exceptions\BusinessException;

class FiliereAlreadyExistException extends BusinessException
{
    public static function createCompetence()
    {
        return new self(__('Filiere already existant'));
    }
}
