<?php

namespace App\Domain\Task\Status\Contracts;

interface DeleteStatusServiceInterface
{
    public function delete(
        int $idStatus
    ): void;
}