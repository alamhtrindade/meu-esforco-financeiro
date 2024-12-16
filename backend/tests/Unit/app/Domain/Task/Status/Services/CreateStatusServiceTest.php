<?php

namespace Tests\Unit\app\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\CreateStatusRepositoryInterface;
use App\Domain\Task\Status\Services\CreateStatusService;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Status\Resources\StatusResource;

class CreateStatusServiceTest extends TestCase
{
    private MockObject|CreateStatusRepositoryInterface $createStatusRepositoryMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->createStatusRepositoryMock = $this->createMock(CreateStatusRepositoryInterface::class);
    }

    public function instanceCreateStatusService()
    {
        return new CreateStatusService(
            $this->createStatusRepositoryMock
        );
    }

    public function test_should_return_success_when_create_new_status()
    {
        $statusDTO = StatusResource::returnStatusDTO();
        $statusClass = StatusResource::returnStatus();

        $instanceClass = $this->instanceCreateStatusService();

        $this->createStatusRepositoryMock
            ->method('create')
            ->with($statusDTO)
            ->willReturn($statusClass);

        $result = $instanceClass->create($statusDTO);

        $this->assertEquals($statusClass, $result);
    }
}