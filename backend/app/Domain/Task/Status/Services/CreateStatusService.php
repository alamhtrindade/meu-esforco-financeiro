<?php

namespace App\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\CreateStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\CreateStatusServiceInterface;
use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;

class CreateStatusService  implements CreateStatusServiceInterface
{
    public function __construct(
        private CreateStatusRepositoryInterface $createStatusRepository
    ) {}

    public function create(
        StatusDTO $statusDTO
    ): Status
    {
        return $this->createStatusRepository->create($statusDTO);
    }
}