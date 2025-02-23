<?php

namespace App\Domain\Expense\Controllers;

use App\Application\Controllers\Controller;
use App\Domain\Expense\Contracts\CreateExpenseServiceInterface;
use App\Domain\Expense\DTO\ExpenseDTO;
use App\Domain\Expense\Requests\ExpenseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    public function __construct(
        private CreateExpenseServiceInterface $createExpenseService
    ){}

    public function create(
        ExpenseRequest $expenseRequest,
        ExpenseDTO $expenseDTO
    ): JsonResponse
    {
        $expenseDTO->value = $expenseRequest->value;
        $expenseDTO->dateExpense = $expenseRequest->date_expense;
        $idPerson = $expenseRequest->id_person;

        $res = $this->createExpenseService->create($idPerson, $expenseDTO);
        
        return response()->json($res, Response::HTTP_OK);
    }
}

