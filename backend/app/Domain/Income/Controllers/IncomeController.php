<?php

namespace App\Domain\Income\Controllers;

use App\Application\Controllers\Controller;
use App\Domain\Income\Contracts\CreateIncomeServiceInterface;
use App\Domain\Income\DTO\IncomeDTO;
use App\Domain\Income\Requests\IncomeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class IncomeController extends Controller
{
    public function __construct(
        private CreateIncomeServiceInterface $createIncomeService
    ){}

    public function create(
        IncomeRequest $incomeRequest,
        IncomeDTO $incomeDTO
    ): JsonResponse
    {
        $incomeDTO->value = $incomeRequest->value;
        $incomeDTO->dateIncome = $incomeRequest->date_income;
        $idPerson = $incomeRequest->id_person;

        $res = $this->createIncomeService->create($idPerson, $incomeDTO);
        
        return response()->json($res, Response::HTTP_OK);
    }
}
