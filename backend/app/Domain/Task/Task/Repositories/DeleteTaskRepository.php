<?php

namespace App\Domain\Task\Task\Repositories;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Task\Contracts\DeleteTaskRepositoryInterface;
use App\Domain\Task\Task\Exceptions\TaskException;
use App\Domain\Task\Task\Models\Task;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskRepository implements DeleteTaskRepositoryInterface
{

    public function __construct(
        private Task $model,
    ){}

    public function delete(
        int $idTask
    ): void
    {
        try{
            DB::begintransaction();
                $this->model
                    ->where($this->model::ID_TASK, $idTask)
                    ->delete();
                
            DB::commit();
        }catch (TaskException $erro){
            DB::rollBack();

            report($erro->getMessage());

            throw new TaskException(
                SystemMessagesEnum::DELETE_ERROR,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}