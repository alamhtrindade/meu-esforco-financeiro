<?php

namespace App\Domain\Task\Task\Contracts;

use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;

interface CreateTaskServiceInterface
{
    public function create(
        TaskDTO $taskTDO
    ): Task;
}