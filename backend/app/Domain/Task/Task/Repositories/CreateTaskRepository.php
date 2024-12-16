<?php

namespace App\Domain\Task\Task\Repositories;

use App\Domain\Task\Task\Contracts\CreateTaskRepositoryInterface;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;
use Illuminate\Support\Facades\DB;

class CreateTaskRepository implements CreateTaskRepositoryInterface
{

    public function __construct(
        private Task $model,
    ){}

    public function create(
        TaskDTO $taskDTO
    ): Task
    {
        DB::begintransaction();

        $task = $this->model->create([
            $this->model::NAME => $taskDTO->name,
            $this->model::DESCRIPTION => $taskDTO->description,
            $this->model::PRIORITY_ID => $taskDTO->priorityId,
            $this->model::STATUS_ID => $taskDTO->statusId,
            $this->model::START_DATE => $taskDTO->startDate,
            $this->model::END_DATE => $taskDTO->endDate,
            $this->model::START_TIME => $taskDTO->startTime,
            $this->model::END_TIME => $taskDTO->endTime
        ]);

        DB::commit();
        
        return $task;
    }
}