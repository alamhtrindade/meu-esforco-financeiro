<?php

namespace App\Domain\Task\Status\Controllers;

use App\Application\Controllers\Controller;
use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Contracts\CreateStatusServiceInterface;
use App\Domain\Task\Status\Contracts\DeleteStatusServiceInterface;
use App\Domain\Task\Status\Contracts\ReadStatusServiceInterface;
use App\Domain\Task\Status\Contracts\UpdateStatusServiceInterface;
use App\Domain\Task\Status\DTO\StatusDTO;
use App\Domain\Task\Status\Requests\StatusRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    public function __construct(
        private CreateStatusServiceInterface $createStatusService,
        private ReadStatusServiceInterface $readStatusService,
        private UpdateStatusServiceInterface $updateStatusService,
        private DeleteStatusServiceInterface $deleteStatusService
    ){}

    public function create(
       StatusRequest $statusRequest,
       StatusDTO $statusDTO
    ): JsonResponse
    {
        $statusDTO->name = $statusRequest->name;
        $statusDTO->active = true;

        $status = $this->createStatusService->create($statusDTO);

        return response()->json($status, Response::HTTP_OK);
    }

    public function read(
        int $idStatus
    ): JsonResponse
    {
        $status = $this->readStatusService->read($idStatus);

        return response()->json($status, Response::HTTP_OK);
    }

    public function update(
        StatusRequest $statusRequest,
        StatusDTO $statusDTO
    ): JsonResponse
    {
        $statusDTO->idStatus = $statusRequest->idStatus;
        $statusDTO->name = $statusRequest->name;
        $statusDTO->active = $statusRequest->active;

        $status = $this->updateStatusService->update($statusDTO);

        return response()->json($status, Response::HTTP_OK);
    }

    public function delete(
        int $idStatus
    ): JsonResponse
    {
        $this->deleteStatusService->delete($idStatus);
        
        return response()->json(SystemMessagesEnum::SUCCESS, Response::HTTP_OK);
    }
}