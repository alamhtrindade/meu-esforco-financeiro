<?php

namespace App\Domain\Task\Status\Repositories;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Contracts\UpdateStatusRepositoryInterface;
use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;
use App\Domain\Task\Task\Exceptions\TaskException;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UpdateStatusRepository implements UpdateStatusRepositoryInterface
{

    public function __construct(
        private Status $model,
    ){}

    public function update(
        StatusDTO $statusDTO
    ): Status
    {

        try{
            DB::begintransaction();
                $this->model
                    ->where($this->model::ID_STATUS, $statusDTO->idStatus)
                    ->update([
                        $this->model::NAME => $statusDTO->name,
                        $this->model::ACTIVE => $statusDTO->active
                    ]);
            DB::commit();

            return $this->model
                    ->where($this->model::ID_STATUS, $statusDTO->idStatus)
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