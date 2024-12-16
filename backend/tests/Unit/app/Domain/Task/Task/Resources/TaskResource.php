<?php

namespace Tests\Unit\app\Domain\Task\Task\Resources;

use App\Domain\Task\Priority\Enums\PriorityEnum;
use App\Domain\Task\Status\Enums\StatusEnum;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Models\Task;

class TaskResource
{
    const ID_TASK = 1;
    const NAME = 'Nome Tarefa';
    const DESCRIPTION = 'Descrição da Tarefa';
    const CATEGORY_ID = 1;
    const PRIORITY_ID = PriorityEnum::LOW;
    const STATUS_ID = StatusEnum::PENDING;
    const START_DATE = '2024/12/14';
    const END_DATE = '2024/12/14';
    const START_TIME = '07:00:00';
    const END_TIME = '07:30:00';

    public static function returnTaskDTO()
    {
        $taskDTO = new TaskDTO();
        $taskDTO->name = self::NAME;
        $taskDTO->description = self::DESCRIPTION;
        $taskDTO->categoryId = self::CATEGORY_ID;
        $taskDTO->priorityId = self::PRIORITY_ID;
        $taskDTO->statusId = self::STATUS_ID;
        $taskDTO->startDate = self::START_DATE;
        $taskDTO->endDate = self::END_DATE;
        $taskDTO->startTime = self::START_TIME;
        $taskDTO->endTime = self::END_TIME;

        return $taskDTO;
    }

    public static function returnTask()
    {
        return Task::make([
            Task::ID_TASK => self::ID_TASK,
            Task::NAME => self::NAME,
            Task::DESCRIPTION => self::DESCRIPTION,
            Task::CATEGORY_ID => self::CATEGORY_ID,
            Task::PRIORITY_ID => self::PRIORITY_ID,
            Task::STATUS_ID => self::STATUS_ID,
            Task::START_DATE => self::START_DATE,
            Task::END_DATE => self::END_DATE,
            Task::START_TIME => self::START_TIME,
            Task::END_TIME => self::END_TIME
        ]);
    }
}