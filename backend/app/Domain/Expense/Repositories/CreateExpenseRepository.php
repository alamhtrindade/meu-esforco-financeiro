<?php

namespace App\Domain\Expense\Repositories;

use App\Domain\Expense\Contracts\CreateExpenseRepositoryInterface;
use App\Domain\Expense\DTO\ExpenseDTO;
use App\Domain\Expense\Models\Expense;
use App\Domain\PersonExpense\Contracts\CreatePersonExpenseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateExpenseRepository implements CreateExpenseRepositoryInterface
{

    public function __construct(
        private Expense $model,
        private CreatePersonExpenseRepositoryInterface $personExpenseRepository
    ){}

    public function create(
        int $idPerson,
        ExpenseDTO $expenseDTO
    ): Expense
    {
        DB::begintransaction();

        $expense = $this->model->create([
            $this->model::VALUE => $expenseDTO->value
        ]);

        $this->personExpenseRepository->create(
            $idPerson,
            $expense->id_expense,
            $expenseDTO->dateExpense
        );

        DB::commit();
        
        return $expense;
    }
}

