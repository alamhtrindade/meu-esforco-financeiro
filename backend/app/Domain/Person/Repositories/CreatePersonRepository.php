<?php

namespace App\Domain\Person\Repositories;

use App\Domain\Person\Contracts\CreatePersonRepositoryInterface;
use App\Domain\Person\DTO\PersonDTO;
use App\Domain\Person\Models\Person;
use Illuminate\Support\Facades\DB;

class CreatePersonRepository implements CreatePersonRepositoryInterface
{

    public function __construct(
        private Person $model,
    ){}

    public function create(
        PersonDTO $personDTO
    ): Person
    {
        DB::begintransaction();

        $person = $this->model->create([
            $this->model::NIF => $personDTO->nif,
            $this->model::NAME => $personDTO->name
        ]);

        DB::commit();
        
        return $person;
    }
}