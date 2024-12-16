<?php

namespace App\Domain\Task\Task\Contracts;

use App\Domain\Task\Task\Models\Task;

interface ReadTaskRepositoryInterface
{
    public function read(
        int $idTask
    ): ?Task;

    public function readAll(): array;
}