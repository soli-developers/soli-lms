<?php

namespace App\Exceptions\pkg_creation_projets;

use App\Exceptions\BusinessException;
use Exception;

class ProjetAlreadyExistException extends BusinessException
{
    public static function createProject()
    {
        return new self(__('pkg_creation_projets/Projet.singular') ." ". __('message.AlreadyExist'));
    }
}
