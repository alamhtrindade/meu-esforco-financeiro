<?php

namespace App\Domain\Task\Status\Repositories;

use App\Domain\Task\Status\Contracts\ReadStatusRepositoryInterface;
use App\Domain\Task\Status\Models\Status;

class ReadStatusRepository implements ReadStatusRepositoryInterface
{
    public function __construct(
        private Status $model,
    ){}

    public function read(
        int $idStatus
    ): ?Status
    {
        return $this->model->where($this->model::ID_STATUS, $idStatus)->first();
    }
}