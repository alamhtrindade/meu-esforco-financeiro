<?php

namespace App\Domain\Expense\Contracts;

use App\Domain\Expense\DTO\ExpenseDTO;
use App\Domain\Expense\Models\Expense;

interface CreateExpenseRepositoryInterface
{
    public function create(
        int $idPerson,
        ExpenseDTO $expenseDTO
    ): Expense;
}
