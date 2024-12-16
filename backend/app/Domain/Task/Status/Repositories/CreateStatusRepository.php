<?php

namespace App\Domain\Task\Status\Repositories;

use App\Domain\Task\Status\Contracts\CreateStatusRepositoryInterface;
use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;
use Illuminate\Support\Facades\DB;

class CreateStatusRepository implements CreateStatusRepositoryInterface
{

    public function __construct(
        private Status $model,
    ){}

    public function create(
        StatusDTO $statusDTO
    ): Status
    {
        DB::begintransaction();

        $status = $this->model->create([
            $this->model::NAME => $statusDTO->name,
            $this->model::ACTIVE => $statusDTO->active
        ]);

        DB::commit();
        
        return $status;
    }
}