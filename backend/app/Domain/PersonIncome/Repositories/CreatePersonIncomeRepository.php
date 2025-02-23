<?php

namespace App\Domain\PersonIncome\Repositories;

use App\Domain\PersonIncome\Contracts\CreatePersonIncomeRepositoryInterface;
use App\Domain\PersonIncome\Models\PersonIncome;
use Illuminate\Support\Facades\DB;

class CreatePersonIncomeRepository implements CreatePersonIncomeRepositoryInterface
{

    public function __construct(
        private PersonIncome $model,
    ){}

    public function create(
        int $idPerson,
        int $idIncome,
        $dateIncome
    ){
        DB::begintransaction();

        $personIncome = $this->model->create([
            $this->model::ID_PERSON => $idPerson,
            $this->model::ID_INCOME => $idIncome,
            $this->model::DATE_INCOME => $dateIncome
        ]);

        DB::commit();
        
        return $personIncome;
    }
}
