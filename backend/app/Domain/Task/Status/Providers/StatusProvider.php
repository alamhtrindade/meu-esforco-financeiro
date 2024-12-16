<?php

namespace App\Domain\Task\Status\Providers;

use App\Domain\Base\Providers\AbstractServiceProvider;
use App\Domain\Task\Status\Contracts\CreateStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\CreateStatusServiceInterface;
use App\Domain\Task\Status\Contracts\DeleteStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\DeleteStatusServiceInterface;
use App\Domain\Task\Status\Contracts\ReadStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\ReadStatusServiceInterface;
use App\Domain\Task\Status\Contracts\UpdateStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\UpdateStatusServiceInterface;
use App\Domain\Task\Status\Repositories\CreateStatusRepository;
use App\Domain\Task\Status\Repositories\DeleteStatusRepository;
use App\Domain\Task\Status\Repositories\ReadStatusRepository;
use App\Domain\Task\Status\Repositories\UpdateStatusRepository;
use App\Domain\Task\Status\Services\CreateStatusService;
use App\Domain\Task\Status\Services\DeleteStatusService;
use App\Domain\Task\Status\Services\ReadStatusService;
use App\Domain\Task\Status\Services\UpdateStatusService;

class StatusProvider extends AbstractServiceProvider
{
    public $bindings = [
       CreateStatusRepositoryInterface::class => CreateStatusRepository::class,
       ReadStatusRepositoryInterface::class => ReadStatusRepository::class,
       UpdateStatusRepositoryInterface::class => UpdateStatusRepository::class,
       DeleteStatusRepositoryInterface::class => DeleteStatusRepository::class
    ];

    public function register()
    {
        $this->bind(
            CreateStatusServiceInterface::class,
            CreateStatusService::class
        );
        $this->bind(
            ReadStatusServiceInterface::class,
            ReadStatusService::class
        );
        $this->bind(
            UpdateStatusServiceInterface::class,
            UpdateStatusService::class
        );
        $this->bind(
            DeleteStatusServiceInterface::class,
            DeleteStatusService::class
        );
    }
}