<?php

namespace App\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\UpdateStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\UpdateStatusServiceInterface;
use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;
use App\Domain\Task\Status\Validations\StatusValidation;

class UpdateStatusService  implements UpdateStatusServiceInterface
{
    public function __construct(
        private UpdateStatusRepositoryInterface $updateStatusRepository,
        private StatusValidation $statusValidation
    ) {}

    public function update(
        StatusDTO $statusDTO
    ): Status
    {
        $this->statusValidation->choseIsValid($statusDTO->idStatus);
        return $this->updateStatusRepository->update($statusDTO);
    }
}