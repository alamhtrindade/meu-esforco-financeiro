<?php

namespace Tests\Unit\app\Domain\Task\Status\Resources;

use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Models\Status;

class StatusResource
{
    const ID_STATUS = 1;
    const NAME = 'Pending';
    const ACTIVE = true;

    public static function returnStatusDTO()
    {
        $taskDTO = new StatusDTO();
        $taskDTO->name = self::NAME;
        $taskDTO->active = self::ACTIVE;

        return $taskDTO;
    }

    public static function returnStatus()
    {
        return Status::make([
            Status::ID_STATUS => self::ID_STATUS,
            Status::NAME => self::NAME,
            Status::ACTIVE => self::ACTIVE
        ]);
    }
}