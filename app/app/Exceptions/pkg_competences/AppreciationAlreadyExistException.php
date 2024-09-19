<?php

namespace App\Exceptions\pkg_competences;

use App\Exceptions\BusinessException;

class AppreciationAlreadyExistException extends BusinessException
{
    public static function createAppreciation()
    {
        return new self(__('Appreciation already existant'));
    }
}
