<?php

namespace App\Domain\Task\Task\Controllers;

use App\Application\Controllers\Controller;
use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Task\Contracts\CreateTaskServiceInterface;
use App\Domain\Task\Task\Contracts\DeleteTaskServiceInterface;
use App\Domain\Task\Task\Contracts\ReadTaskServiceInterface;
use App\Domain\Task\Task\Contracts\UpdateTaskServiceInterface;
use App\Domain\Task\Task\DTO\TaskDTO;
use App\Domain\Task\Task\Requests\TaskRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(
        private CreateTaskServiceInterface $createTaskService,
        private ReadTaskServiceInterface $readTaskService,
        private UpdateTaskServiceInterface $updateTaskService,
        private DeleteTaskServiceInterface $deleteTaskService
    ){}

    public function create(
        TaskRequest $taskRequest,
        TaskDTO $taskDTO
    ): JsonResponse
    {
        $taskDTO->name = $taskRequest->name;
        $taskDTO->description = $taskRequest->description;
        $taskDTO->priorityId = $taskRequest->priority;
        $taskDTO->statusId = $taskRequest->status;
        $taskDTO->startDate = $taskRequest->startDate;
        $taskDTO->endDate = $taskRequest->endDate;
        $taskDTO->startTime = $taskRequest->startTime;
        $taskDTO->endTime = $taskRequest->endTime;

        $task = $this->createTaskService->create($taskDTO);

        return response()->json($task, Response::HTTP_OK);
    }

    public function read(
        int $idTask
    ): JsonResponse
    {
        $task = $this->readTaskService->read($idTask);

        return response()->json($task, Response::HTTP_OK);
    }

    public function update(
        TaskRequest $taskRequest,
        TaskDTO $taskDTO
    ): JsonResponse
    {
        $taskDTO->idTask = $taskRequest->id;
        $taskDTO->name = $taskRequest->name;
        $taskDTO->description = $taskRequest->description;
        $taskDTO->priorityId = $taskRequest->priority;
        $taskDTO->statusId = $taskRequest->status;
        $taskDTO->startDate = $taskRequest->startDate;
        $taskDTO->endDate = $taskRequest->endDate;
        $taskDTO->startTime = $taskRequest->startTime;
        $taskDTO->endTime = $taskRequest->endTime;

        $task = $this->updateTaskService->update($taskDTO);

        return response()->json($task, Response::HTTP_OK);
    }

    public function delete(
        int $idTask
    ): JsonResponse
    {
        $this->deleteTaskService->delete($idTask);

        return response()->json(SystemMessagesEnum::SUCCESS, Response::HTTP_OK);
    }

    public function readAll(): JsonResponse
    {
        $tasks = $this->readTaskService->readAll();

        return response()->json($tasks, Response::HTTP_OK);
    }
}