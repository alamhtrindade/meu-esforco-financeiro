<?php

namespace App\Domain\PersonIncome\Contracts;

interface CreatePersonIncomeRepositoryInterface
{
    public function create(
        int $idPerson,
        int $idIncome,
        $dateIncome
    );
}
