<?php

namespace App\Domain\Task\Task\Contracts;

interface DeleteTaskServiceInterface
{
    public function delete(
        int $idTask
    ): void;
}