<?php

namespace App\Domain\Task\Task\Contracts;

use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;

interface CreateTaskRepositoryInterface
{
    public function create(
        TaskDTO $taskDTO
    ): Task;
}