<?php

namespace App\Domain\Task\Task\Services;

use App\Domain\Task\Task\Contracts\UpdateTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\UpdateTaskServiceInterface;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;
use App\Domain\Task\Task\Validations\TaskValidation;

class UpdateTaskService  implements UpdateTaskServiceInterface
{
    public function __construct(
        private UpdateTaskRepositoryInterface $updateTaskRepository,
        private TaskValidation $taskValidation
    ) {}

    public function update(
        TaskDTO $taskDTO
    ): Task
    {
        $this->executeValidations($taskDTO);

        $taskDTO = $this->taskValidation->normalizeTaskToCreate($taskDTO);
       
        return $this->updateTaskRepository->update($taskDTO);
    }

    private function executeValidations(
        TaskDTO $taskDTO
    ): void
    {
        $this->taskValidation->dateIsValid(
            $taskDTO->startDate,
            $taskDTO->endDate
        );
    }
}