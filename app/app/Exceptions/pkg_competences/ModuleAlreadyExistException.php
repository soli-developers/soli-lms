<?php

namespace App\Exceptions\pkg_competences;

use App\Exceptions\BusinessException;

class ModuleAlreadyExistException extends BusinessException
{
    public static function createModule()
    {
        return new self(__('Module already existant'));
    }
}
