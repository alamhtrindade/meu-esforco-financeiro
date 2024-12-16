<?php

namespace App\Domain\Task\Task\Services;

use App\Domain\Task\Task\Contracts\CreateTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\CreateTaskServiceInterface;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;
use App\Domain\Task\Task\Validations\TaskValidation;

class CreateTaskService  implements CreateTaskServiceInterface
{

    public function __construct(
        private CreateTaskRepositoryInterface $createTaskRepository,
        private TaskValidation $taskValidation
    ) {}

    public function create(
        TaskDTO $taskDTO
    ): Task
    {
        $this->executeValidations($taskDTO);

        $taskDTO = $this->taskValidation->normalizeTaskToCreate($taskDTO);

        return $this->createTaskRepository->create($taskDTO);
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