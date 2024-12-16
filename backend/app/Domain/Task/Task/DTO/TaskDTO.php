<?php

namespace App\Domain\Task\Task\DTO;

class TaskDTO
{
    public ?int $idTask;
    public ?string $name;
    public ?string $description;
    public ?int $priorityId;
    public ?int $statusId;
    public ?string $startDate;
    public ?string $endDate;
    public ?string $startTime;
    public ?string $endTime;
}