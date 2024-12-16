<?php

namespace App\Application\Validations\Rules;

class TaskRules
{
    public function arrayAlwaysPopulated($attribute, $valorCampoAtual): bool
    {
        return !empty($valorCampoAtual);
    }
}
