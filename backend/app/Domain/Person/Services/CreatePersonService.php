<?php

namespace App\Domain\Person\Services;

use App\Domain\Person\DTO\PersonDTO;
use App\Domain\Person\Models\Person;
use App\Domain\Person\Contracts\CreatePersonRepositoryInterface;
use App\Domain\Person\Contracts\CreatePersonServiceInterface;
use App\Domain\Person\Validations\PersonValidation;

class CreatePersonService  implements CreatePersonServiceInterface
{
    public function __construct(
        private CreatePersonRepositoryInterface $createPersonRepository,
        private PersonValidation $personValidation
    ) {}

    public function create(
        PersonDTO $personDTO
    ): Person
    {

        $this->personValidation->checkNifIsRegistred($personDTO->nif);

        return $this->createPersonRepository->create($personDTO);
    }
}