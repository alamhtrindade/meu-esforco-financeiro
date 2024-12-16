<?php

namespace App\Domain\Task\Status\Repositories;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Contracts\DeleteStatusRepositoryInterface;
use App\Domain\Task\Status\Models\Status;
use App\Domain\Task\Task\Exceptions\TaskException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DeleteStatusRepository implements DeleteStatusRepositoryInterface
{

    public function __construct(
        private Status $model,
    ){}

    public function delete(
        int $idStatus
    ): void
    {
        try{
            DB::begintransaction();
                $this->model
                    ->where($this->model::ID_STATUS, $idStatus)
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