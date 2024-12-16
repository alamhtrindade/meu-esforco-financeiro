<?php

namespace App\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\ReadStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\ReadStatusServiceInterface;
use App\Domain\Task\Status\Models\Status;

class ReadStatusService  implements ReadStatusServiceInterface
{
    public function __construct(
        private ReadStatusRepositoryInterface $readStatusRepository
    ) {}

    public function read(
        int $idStatus
    ): ?Status
    {
        return $this->readStatusRepository->read($idStatus);
    }
}