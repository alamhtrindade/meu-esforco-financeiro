<?php

namespace App\Domain\Task\Status\Enums;

use BenSampo\Enum\Enum;

final class StatusEnum extends Enum
{
    const PENDING = 1;
    const COMPLETED = 2;
}