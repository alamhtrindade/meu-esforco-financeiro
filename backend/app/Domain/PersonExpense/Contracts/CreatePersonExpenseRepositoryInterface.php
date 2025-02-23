<?php

namespace App\Domain\PersonExpense\Contracts;

interface CreatePersonExpenseRepositoryInterface
{
    public function create(
        int $idPerson,
        int $idExpense,
        $dateExpense
    );
}
