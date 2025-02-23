<?php

namespace App\Domain\Expense\Services;

use App\Domain\Expense\Contracts\CreateExpenseRepositoryInterface;
use App\Domain\Expense\Contracts\CreateExpenseServiceInterface;
use App\Domain\Expense\DTO\ExpenseDTO;
use App\Domain\Expense\Models\Expense;

class CreateExpenseService implements CreateExpenseServiceInterface
{
    public function __construct(
        private CreateExpenseRepositoryInterface $createExpenseRepository
    ){}

    public function create(
        int $idPerson,
        ExpenseDTO $expenseDTO
    ): Expense
    {
        return $this->createExpenseRepository->create( $idPerson, $expenseDTO );
    }
}

