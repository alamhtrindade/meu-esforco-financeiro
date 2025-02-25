<?php

namespace App\Domain\Person\Contracts;

use App\Domain\Person\Models\Person;

interface ReadPersonRepositoryInterface
{
    public function readAll(
        int $month
    );

    public function readByPersonAndMonth(
        $idPerson,
        $month,
        $year
    );

    public function readPersonByNif(
        int $nif
    ): ?Person;
}