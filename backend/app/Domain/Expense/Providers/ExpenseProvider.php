<?php

namespace App\Domain\Expense\Providers;

use App\Domain\Base\Providers\AbstractServiceProvider;
use App\Domain\Expense\Contracts\CreateExpenseRepositoryInterface;
use App\Domain\Expense\Contracts\CreateExpenseServiceInterface;
use App\Domain\Expense\Repositories\CreateExpenseRepository;
use App\Domain\PersonExpense\Repositories\CreatePersonExpenseRepository;
use App\Domain\Expense\Services\CreateExpenseService;
use App\Domain\PersonExpense\Contracts\CreatePersonExpenseRepositoryInterface;

class ExpenseProvider extends AbstractServiceProvider
{
    public $bindings = [
       CreateExpenseRepositoryInterface::class => CreateExpenseRepository::class,
       CreatePersonExpenseRepositoryInterface::class => CreatePersonExpenseRepository::class
    ];

    public function register()
    {
        $this->bind(
            CreateExpenseServiceInterface::class,
            CreateExpenseService::class
        );

    }
}
