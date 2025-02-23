<?php

namespace App\Domain\Person\Repositories;

use App\Domain\Person\Contracts\ReadPersonRepositoryInterface;
use App\Domain\Person\Models\Person;
use App\Domain\Expense\Models\Expense;
use App\Domain\Income\Models\Income;
use App\Domain\PersonExpense\Models\PersonExpense;
use App\Domain\PersonIncome\Models\PersonIncome;
use Illuminate\Support\Facades\DB;

class ReadPersonRepository implements ReadPersonRepositoryInterface
{

    public function __construct(
        private Person $model,
    ){}

    public function readAll(
        int $month
    ){
        return $this->model::with([
            'credited' => function ($query) use ($month) {
                $query->select(
                    PersonIncome::campoCompleto(PersonIncome::ID_PERSON_INCOME, 'id'),
                    PersonIncome::campoCompleto(PersonIncome::ID_PERSON),
                    Income::campoCompleto(Income::VALUE),
                    PersonIncome::campoCompleto(PersonIncome::DATE_INCOME, 'date'),
                    DB::raw('"credited" as type')
                )
                ->join(
                    Income::nomeTabela(),
                    Income::campoCompleto(Income::ID_INCOME),
                    PersonIncome::campoCompleto(PersonIncome::ID_INCOME)
                )
                ->whereMonth(PersonIncome::campoCompleto(PersonIncome::DATE_INCOME), $month);
            },
            'debited' => function ($query) use ($month) {
                $query->select(
                    PersonExpense::campoCompleto(PersonExpense::ID_PERSON_EXPENSE, 'id'),
                    PersonExpense::campoCompleto(PersonExpense::ID_PERSON),
                    Expense::campoCompleto(Expense::VALUE),
                    PersonExpense::campoCompleto(PersonExpense::DATE_EXPENSE, 'date'),
                    DB::raw('"debited" as type')
                )
                ->join(
                    Expense::nomeTabela(),
                    Expense::campoCompleto(Expense::ID_EXPENSE),
                    PersonExpense::campoCompleto(PersonExpense::ID_EXPENSE)
                )
                ->whereMonth(PersonExpense::campoCompleto(PersonExpense::DATE_EXPENSE), $month);
            }
        ])
        ->get();
    }
    
    public function readByPersonAndMonth(
        $idPerson,
        $month,
        $year
    ){
        return $this->model::where(Person::ID_PERSON, $idPerson)
        ->with([
            'credited' => function ($query) use ($month, $year) {
                $query->select(
                    PersonIncome::campoCompleto(PersonIncome::ID_PERSON_INCOME, 'id'),
                    PersonIncome::campoCompleto(PersonIncome::ID_PERSON),
                    Income::campoCompleto(Income::VALUE),
                    PersonIncome::campoCompleto(PersonIncome::DATE_INCOME, 'date'),
                    DB::raw('"credited" as type')
                )
                ->join(
                    Income::nomeTabela(),
                    Income::campoCompleto(Income::ID_INCOME),
                    PersonIncome::campoCompleto(PersonIncome::ID_INCOME)
                )
                ->whereMonth(PersonIncome::campoCompleto(PersonIncome::DATE_INCOME), $month)
                ->whereYear(PersonIncome::campoCompleto(PersonIncome::DATE_INCOME), $year);
            },
            'debited' => function ($query) use ($month, $year) {
                $query->select(
                    PersonExpense::campoCompleto(PersonExpense::ID_PERSON_EXPENSE, 'id'),
                    PersonExpense::campoCompleto(PersonExpense::ID_PERSON),
                    Expense::campoCompleto(Expense::VALUE),
                    PersonExpense::campoCompleto(PersonExpense::DATE_EXPENSE, 'date'),
                    DB::raw('"debited" as type')
                )
                ->join(
                    Expense::nomeTabela(),
                    Expense::campoCompleto(Expense::ID_EXPENSE),
                    PersonExpense::campoCompleto(PersonExpense::ID_EXPENSE)
                )
                ->whereMonth(PersonExpense::campoCompleto(PersonExpense::DATE_EXPENSE), $month)
                ->whereYear(PersonExpense::campoCompleto(PersonExpense::DATE_EXPENSE), $year);
            }
        ])
        ->first();
    }
}