<?php

namespace App\Domain\Income\Repositories;

use App\Domain\Income\Contracts\CreateIncomeRepositoryInterface;
use App\Domain\Income\DTO\IncomeDTO;
use App\Domain\Income\Models\Income;
use App\Domain\PersonIncome\Contracts\CreatePersonIncomeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateIncomeRepository implements CreateIncomeRepositoryInterface
{

    public function __construct(
        private Income $model,
        private CreatePersonIncomeRepositoryInterface $personIncomeRepository
    ){}

    public function create(
        int $idPerson,
        IncomeDTO $incomeDTO
    ): Income
    {
        DB::begintransaction();

        $income = $this->model->create([
            $this->model::VALUE => $incomeDTO->value
        ]);

        $this->personIncomeRepository->create(
            $idPerson,
            $income->id_income,
            $incomeDTO->dateIncome
        );

        DB::commit();
        
        return $income;
    }
}
