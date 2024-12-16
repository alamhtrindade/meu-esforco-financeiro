<?php

namespace App\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\DeleteStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\DeleteStatusServiceInterface;
use App\Domain\Task\Status\Validations\StatusValidation;

class DeleteStatusService  implements DeleteStatusServiceInterface
{
    public function __construct(
        private DeleteStatusRepositoryInterface $deleteStatusRepository,
        private StatusValidation $statusValidation
    ) {}

    public function delete(
        int $idStatus
    ): void
    {
        $this->statusValidation->choseIsValid($idStatus);
        $this->deleteStatusRepository->delete($idStatus);
    }
}