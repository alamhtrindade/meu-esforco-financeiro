<?php

namespace App\Domain\Task\Task\Contracts;

interface DeleteTaskRepositoryInterface
{
    public function delete(
        int $idTask
    ): void;
}