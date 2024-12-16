<?php

namespace Tests\Unit\app\Domain\Task\Status\Services;

use App\Domain\Task\Status\Contracts\ReadStatusRepositoryInterface;
use App\Domain\Task\Status\Services\ReadStatusService;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Status\Resources\StatusResource;

class ReadStatusServiceTest extends TestCase
{
    private MockObject|ReadStatusRepositoryInterface $readStatusRepositoryMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->readStatusRepositoryMock = $this->createMock(ReadStatusRepositoryInterface::class);
    }

    public function instanceReadStatusService()
    {
        return new ReadStatusService(
            $this->readStatusRepositoryMock
        );
    }

    public function test_should_return_status()
    {
        $statusClass = StatusResource::returnStatus();

        $instanceClass = $this->instanceReadStatusService();

        $this->readStatusRepositoryMock
            ->method('read')
            ->with($statusClass->id_status)
            ->willReturn($statusClass);

        $result = $instanceClass->read($statusClass->id_status);

        $this->assertEquals($statusClass, $result);
    }

    public function test_should_return_status_empty()
    {
        $statusClass = null;

        $instanceClass = $this->instanceReadStatusService();

        $this->readStatusRepositoryMock
            ->method('read')
            ->with(0)
            ->willReturn($statusClass);

        $result = $instanceClass->read(0);

        $this->assertEquals($statusClass, $result);
    }
}