<?php

namespace App\Domain\Income\Providers;

use App\Domain\Base\Providers\AbstractServiceProvider;
use App\Domain\Income\Contracts\CreateIncomeRepositoryInterface;
use App\Domain\Income\Contracts\CreateIncomeServiceInterface;
use App\Domain\Income\Repositories\CreateIncomeRepository;
use App\Domain\PersonIncome\Repositories\CreatePersonIncomeRepository;
use App\Domain\Income\Services\CreateIncomeService;
use App\Domain\PersonIncome\Contracts\CreatePersonIncomeRepositoryInterface;

class IncomeProvider extends AbstractServiceProvider
{
    public $bindings = [
       CreateIncomeRepositoryInterface::class => CreateIncomeRepository::class,
       CreatePersonIncomeRepositoryInterface::class => CreatePersonIncomeRepository::class
    ];

    public function register()
    {
        $this->bind(
            CreateIncomeServiceInterface::class,
            CreateIncomeService::class
        );

    }
}