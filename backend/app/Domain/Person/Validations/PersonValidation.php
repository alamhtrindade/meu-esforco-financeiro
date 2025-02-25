<?php

namespace App\Domain\Person\Validations;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Person\Contracts\ReadPersonRepositoryInterface;
use App\Domain\Person\Exceptions\PersonException;
use Symfony\Component\HttpFoundation\Response;

class PersonValidation
{
    public function __construct(
        private ReadPersonRepositoryInterface $readPersonRepository
    ){}

    public function checkNifIsRegistred(
        int $nif
    )
    {
        $person = $this->readPersonRepository->readPersonByNif($nif);

        if( !empty($person) ){
            throw new PersonException(
                SystemMessagesEnum::NIF_ARE_REGISTERED,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}