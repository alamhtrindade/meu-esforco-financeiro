<?php

namespace App\Domain\PersonExpense\Repositories;

use App\Domain\PersonExpense\Contracts\CreatePersonExpenseRepositoryInterface;
use App\Domain\PersonExpense\Models\PersonExpense;
use Illuminate\Support\Facades\DB;

class CreatePersonExpenseRepository implements CreatePersonExpenseRepositoryInterface
{

    public function __construct(
        private PersonExpense $model,
    ){}

    public function create(
        int $idPerson,
        int $idExpense,
        $dateExpense
    ){
        DB::begintransaction();

        $personIncome = $this->model->create([
            $this->model::ID_PERSON => $idPerson,
            $this->model::ID_EXPENSE => $idExpense,
            $this->model::DATE_EXPENSE => $dateExpense
        ]);

        DB::commit();
        
        return $personIncome;
    }
}
