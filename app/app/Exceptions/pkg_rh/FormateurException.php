<?php

namespace App\Exceptions\pkg_rh;

use Exception;

class FormateurException extends Exception
{
    public static function AlreadyExistFormateur()
    {
        return new self(__('pkg_rh/Formateur.singular') . ' est deja exist');
    }
}
