<?php

namespace App\Domain\Task\Task\Repositories;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Task\Contracts\UpdateTaskRepositoryInterface;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Exceptions\TaskException;
use App\Domain\Task\Task\Models\Task;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UpdateTaskRepository implements UpdateTaskRepositoryInterface
{

    public function __construct(
        private Task $model,
    ){}

    public function update(
        TaskDTO $taskDTO
    ): Task
    {

        try{
            DB::begintransaction();
                $this->model
                    ->where($this->model::ID_TASK, $taskDTO->idTask)
                    ->update([
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

            return $this->model
                    ->where($this->model::ID_TASK, $taskDTO->idTask)
                    ->first();
                    
        }catch (TaskException $erro){
            DB::rollBack();

            report($erro->getMessage());

            throw new TaskException(
                SystemMessagesEnum::UPDATE_ERROR,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}