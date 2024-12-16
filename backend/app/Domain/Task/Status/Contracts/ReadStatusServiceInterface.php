<?php

namespace App\Domain\Task\Status\Contracts;

use App\Domain\Task\Status\Models\Status;

interface ReadStatusServiceInterface
{
    public function read(
        int $idStatus
    ): ?Status;
}