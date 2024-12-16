<?php

namespace App\Domain\Task\Task\Providers;

use App\Domain\Base\Providers\AbstractServiceProvider;
use App\Domain\Task\Task\Contracts\CreateTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\CreateTaskServiceInterface;
use App\Domain\Task\Task\Contracts\DeleteTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\DeleteTaskServiceInterface;
use App\Domain\Task\Task\Contracts\ReadTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\ReadTaskServiceInterface;
use App\Domain\Task\Task\Contracts\UpdateTaskRepositoryInterface;
use App\Domain\Task\Task\Contracts\UpdateTaskServiceInterface;
use App\Domain\Task\Task\Repositories\CreateTaskRepository;
use App\Domain\Task\Task\Repositories\DeleteTaskRepository;
use App\Domain\Task\Task\Repositories\ReadTaskRepository;
use App\Domain\Task\Task\Repositories\UpdateTaskRepository;
use App\Domain\Task\Task\Services\CreateTaskService;
use App\Domain\Task\Task\Services\DeleteTaskService;
use App\Domain\Task\Task\Services\ReadTaskService;
use App\Domain\Task\Task\Services\UpdateTaskService;

class TaskProvider extends AbstractServiceProvider
{
    public $bindings = [
       CreateTaskRepositoryInterface::class => CreateTaskRepository::class,
       ReadTaskRepositoryInterface::class => ReadTaskRepository::class,
       UpdateTaskRepositoryInterface::class => UpdateTaskRepository::class,
       DeleteTaskRepositoryInterface::class => DeleteTaskRepository::class
    ];

    public function register()
    {
        $this->bind(
            CreateTaskServiceInterface::class,
            CreateTaskService::class
        );
        $this->bind(
            ReadTaskServiceInterface::class,
            ReadTaskService::class
        );
        $this->bind(
            UpdateTaskServiceInterface::class,
            UpdateTaskService::class
        );
        $this->bind(
            DeleteTaskServiceInterface::class,
            DeleteTaskService::class
        );
    }
}