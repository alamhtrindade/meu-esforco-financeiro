<?php

namespace App\Domain\Income\Contracts;

use App\Domain\Income\DTO\IncomeDTO;
use App\Domain\Income\Models\Income;

interface CreateIncomeServiceInterface
{
    public function create(
        int $idPerson,
        IncomeDTO $incomeDTO
    ): Income;
}
