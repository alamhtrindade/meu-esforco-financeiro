<?php

namespace App\Domain\Person\Providers;

use App\Domain\Base\Providers\AbstractServiceProvider;
use App\Domain\Person\Contracts\CreatePersonRepositoryInterface;
use App\Domain\Person\Contracts\CreatePersonServiceInterface;
use App\Domain\Person\Contracts\ReadPersonRepositoryInterface;
use App\Domain\Person\Contracts\ReadPersonServiceInterface;
use App\Domain\Person\Repositories\CreatePersonRepository;
use App\Domain\Person\Repositories\ReadPersonRepository;
use App\Domain\Person\Services\CreatePersonService;
use App\Domain\Person\Services\ReadPersonService;

class PersonProvider extends AbstractServiceProvider
{
    public $bindings = [
       CreatePersonRepositoryInterface::class => CreatePersonRepository::class,
       ReadPersonRepositoryInterface::class => ReadPersonRepository::class
    ];

    public function register()
    {
        $this->bind(
            CreatePersonServiceInterface::class,
            CreatePersonService::class
        );

        $this->bind(
            ReadPersonServiceInterface::class,
            ReadPersonService::class
        );
    }
}