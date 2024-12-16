<?php

namespace App\Domain\Task\Task\Repositories;

use App\Domain\Task\Task\Contracts\ReadTaskRepositoryInterface;
use App\Domain\Task\Task\Models\Task;

class ReadTaskRepository implements ReadTaskRepositoryInterface
{

    public function __construct(
        private Task $model,
    ){}

    public function read(
        int $idTask
    ): ?Task
    {
        return $this->model->where($this->model::ID_TASK, $idTask)->first();
    }

    public function readAll(): array
    {
        return $this->model
                    ->orderBy($this->model::PRIORITY_ID, 'DESC')
                    ->get()->toArray();
    }
}