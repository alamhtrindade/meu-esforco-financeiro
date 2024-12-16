<?php

namespace App\Domain\Task\Status\Contracts;

use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;

interface UpdateStatusServiceInterface
{
    public function update(
        StatusDTO $statusDTO
    ): Status;
}