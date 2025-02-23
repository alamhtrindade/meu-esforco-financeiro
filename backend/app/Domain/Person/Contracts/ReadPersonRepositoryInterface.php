<?php

namespace App\Domain\Person\Contracts;

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
}