<?php

namespace App\Domain\Person\Services;

use App\Domain\Person\DTO\PersonDTO;
use App\Domain\Person\Models\Person;
use App\Domain\Person\Contracts\CreatePersonRepositoryInterface;
use App\Domain\Person\Contracts\CreatePersonServiceInterface;

class CreatePersonService  implements CreatePersonServiceInterface
{
    public function __construct(
        private CreatePersonRepositoryInterface $createPersonRepository
    ) {}

    public function create(
        PersonDTO $personDTO
    ): Person
    {
        return $this->createPersonRepository->create($personDTO);
    }
}