<?php

namespace App\Domain\Task\Status\Contracts;

use App\Domain\Task\Status\Models\Status;

interface ReadStatusRepositoryInterface
{
    public function read(
        int $idTask
    ): ?Status;
}