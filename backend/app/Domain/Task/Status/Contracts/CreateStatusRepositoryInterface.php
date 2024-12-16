<?php

namespace App\Domain\Task\Status\Contracts;

use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;

interface CreateStatusRepositoryInterface
{
    public function create(
        StatusDTO $statusDTO
    ): Status;
}