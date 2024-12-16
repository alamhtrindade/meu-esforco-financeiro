<?php

namespace App\Domain\Task\Task\Services;

use App\Domain\Task\Task\Contracts\ReadTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\ReadTaskServiceInterface;
use App\Domain\Task\Task\Models\Task;
use PhpParser\Node\Expr\Cast\Array_;

class ReadTaskService  implements ReadTaskServiceInterface
{
    public function __construct(
        private ReadTaskRepositoryInterface $readTaskRepository
    ) {}

    public function read(
        int $idTask
    ): ?Task
    {
        return $this->readTaskRepository->read($idTask);
    }

    public function readAll(): array
    {
        return $this->readTaskRepository->readAll();
    }
}