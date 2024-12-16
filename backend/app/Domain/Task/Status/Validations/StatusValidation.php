<?php

namespace App\Domain\Task\Status\Validations;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Enums\StatusEnum;
use App\Domain\Task\Status\Exceptions\StatusException;
use Symfony\Component\HttpFoundation\Response;

class StatusValidation
{ 
    public function choseIsValid(
        int $idStatus
    ): void
    {
        if(
            $idStatus === StatusEnum::PENDING ||
            $idStatus === StatusEnum::COMPLETED
        ){
            throw new StatusException(
                SystemMessagesEnum::DELETE_NOT_POSSIBLE,
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}