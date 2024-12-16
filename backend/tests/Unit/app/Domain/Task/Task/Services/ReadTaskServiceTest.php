<?php

namespace Tests\Unit\app\Domain\Task\Task\Services;

use App\Domain\Task\Task\Contracts\ReadTaskRepositoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use App\Domain\Task\Task\Services\ReadTaskService;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Task\Resources\TaskResource;

class ReadTaskServiceTest extends TestCase
{
    private MockObject|ReadTaskRepositoryInterface $readTaskRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->readTaskRepositoryMock = $this->createMock(ReadTaskRepositoryInterface::class);
    }

    public function instanceUpdateTaskService()
    {
        return new ReadTaskService(
            $this->readTaskRepositoryMock
        );
    }

    public function test_should_return_task()
    {
        $taskClass = TaskResource::returnTask();

        $instanceClass = $this->instanceUpdateTaskService();
    
        $this->readTaskRepositoryMock
            ->method('read')
            ->willReturn($taskClass);

        $result = $instanceClass->read($taskClass->id_task);

        $this->assertEquals($taskClass, $result);
    }

    public function test_should_return_empty_task()
    {
        $taskClass = null;

        $instanceClass = $this->instanceUpdateTaskService();
    
        $this->readTaskRepositoryMock
            ->method('read')
            ->willReturn($taskClass);

        $result = $instanceClass->read(0);

        $this->assertEquals($taskClass, $result);
    }
    
}