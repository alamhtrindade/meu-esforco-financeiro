<?php

namespace App\Domain\Person\Contracts;

use App\Domain\Person\DTO\PersonDTO;
use App\Domain\Person\Models\Person;

interface CreatePersonServiceInterface
{
    public function create(
        PersonDTO $personDTO
    ): Person;
}