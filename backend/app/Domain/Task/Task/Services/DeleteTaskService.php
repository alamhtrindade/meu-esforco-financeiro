<?php

namespace App\Domain\Task\Task\Services;

use App\Domain\Task\Task\Contracts\DeleteTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\DeleteTaskServiceInterface;

class DeleteTaskService  implements DeleteTaskServiceInterface
{

    public function __construct(
        private DeleteTaskRepositoryInterface $deleteTaskRepository
    ) {}

    public function delete(
        int $idTask
    ): void
    {
        $this->deleteTaskRepository->delete($idTask);
    }
}