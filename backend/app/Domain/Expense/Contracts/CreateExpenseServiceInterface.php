<?php

namespace App\Domain\Expense\Contracts;

use App\Domain\Expense\DTO\ExpenseDTO;
use App\Domain\Expense\Models\Expense;

interface CreateExpenseServiceInterface
{
    public function create(
        int $idPerson,
        ExpenseDTO $expenseDTO
    ): Expense;
}
