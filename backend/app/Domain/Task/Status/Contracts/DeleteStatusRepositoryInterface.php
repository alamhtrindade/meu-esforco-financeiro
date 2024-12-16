<?php

namespace App\Domain\Task\Status\Contracts;

interface DeleteStatusRepositoryInterface
{
    public function delete(
        int $idTask
    ): void;
}