<?php

namespace App\Domain\Task\Priority\Enums;

use BenSampo\Enum\Enum;

final class PriorityEnum extends Enum
{
    const NO_PRIORITY = 1;
    const LOW = 2;
    const MEDIUM = 3;
    const HIGH = 4;
    const CRITICAL = 5;
}