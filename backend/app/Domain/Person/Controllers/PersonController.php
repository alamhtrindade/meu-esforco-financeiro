<?php

namespace App\Domain\Person\Controllers;

use App\Application\Controllers\Controller;
use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Person\Contracts\CreatePersonServiceInterface;
use App\Domain\Person\Contracts\ReadPersonServiceInterface;
use App\Domain\Person\DTO\PersonDTO;
use App\Domain\Person\Requests\PersonRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PersonController extends Controller
{
    public function __construct(
        private CreatePersonServiceInterface $createPersonService,
        private ReadPersonServiceInterface $readPersonService
    ){}

    public function create(
       PersonRequest $personRequest,
       PersonDTO $personDTO
    ): JsonResponse
    {
        
        $personDTO->name = $personRequest->name;
        $personDTO->nif = $personRequest->nif;

        $person = $this->createPersonService->create($personDTO);

        return response()->json($person, Response::HTTP_OK);
    }

    public function read(
        $id = null,
        $mounth = null
    ): JsonResponse
    {
        $data = $this->readPersonService->read($id, $mounth);

        return response()->json($data, Response::HTTP_OK);
    }
}