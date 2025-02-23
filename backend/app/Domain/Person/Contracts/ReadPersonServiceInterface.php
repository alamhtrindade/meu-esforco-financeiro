<?php

namespace App\Domain\Person\Contracts;

interface ReadPersonServiceInterface
{
    public function read(
        $idPerson,
        $date
    );
}