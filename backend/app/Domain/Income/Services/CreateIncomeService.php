<?php

namespace App\Domain\Income\Services;

use App\Domain\Income\Contracts\CreateIncomeRepositoryInterface;
use App\Domain\Income\Contracts\CreateIncomeServiceInterface;
use App\Domain\Income\DTO\IncomeDTO;
use App\Domain\Income\Models\Income;

class CreateIncomeService implements CreateIncomeServiceInterface
{
    public function __construct(
        private CreateIncomeRepositoryInterface $createIncomeRepository
    ){}

    public function create(
        int $idPerson,
        IncomeDTO $incomeDTO
    ): Income
    {
        return $this->createIncomeRepository->create( $idPerson, $incomeDTO );
    }
}
