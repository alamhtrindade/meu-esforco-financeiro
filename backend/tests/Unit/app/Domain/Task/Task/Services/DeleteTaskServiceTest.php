<?php

namespace Tests\Unit\app\Domain\Task\Task\Services;

use PHPUnit\Framework\MockObject\MockObject;
use App\Domain\Task\Task\Contracts\DeleteTaskRepositoryInterface;
use App\Domain\Task\Task\Services\DeleteTaskService;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Task\Resources\TaskResource;

class DeleteTaskServiceTest extends TestCase
{
    private MockObject|DeleteTaskRepositoryInterface $deleteTaskRepositoryMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteTaskRepositoryMock = $this->createMock(DeleteTaskRepositoryInterface::class);
    }

    public function instanceDeleteTaskService()
    {
        return new DeleteTaskService(
            $this->deleteTaskRepositoryMock
        );
    }

    public function test_should_return_success_when_update_task()
    {
        $idTask = TaskResource::returnTask()->id_task;

        $instanceClass = $this->instanceDeleteTaskService();

        $this->deleteTaskRepositoryMock
            ->expects($this->once())
            ->method('delete')
            ->with($idTask);

        $instanceClass->delete($idTask);
    }
}