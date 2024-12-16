<?php

namespace Tests\Unit\app\Domain\Task\Status\Services;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Contracts\UpdateStatusRepositoryInterface;
use App\Domain\Task\Status\Exceptions\StatusException;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Task\Status\Services\UpdateStatusService;
use App\Domain\Task\Status\Validations\StatusValidation;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Status\Resources\StatusResource;

class UpdateStatusServiceTest extends TestCase
{
    private MockObject|UpdateStatusRepositoryInterface $updateStatusRepositoryMock;
    private MockObject|StatusValidation $statusValidationMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->updateStatusRepositoryMock = $this->createMock(UpdateStatusRepositoryInterface::class);
        $this->statusValidationMock = $this->createMock(StatusValidation::class);
    }

    public function instanceUpdateStatusService()
    {
        return new UpdateStatusService(
            $this->updateStatusRepositoryMock,
            $this->statusValidationMock
        );
    }

    public function test_should_return_success_when_update_status()
    {
        $statusDTO = StatusResource::returnStatusDTO();
        $statusDTO->idStatus = 3;

        $statusClass = StatusResource::returnStatus();

        $instanceClass = $this->instanceUpdateStatusService();

        $this->statusValidationMock
            ->method('choseIsValid')
            ->with($statusDTO->idStatus);

        $this->updateStatusRepositoryMock
            ->method('update')
            ->with($statusDTO)
            ->willReturn($statusClass);

        $result = $instanceClass->update($statusDTO);

        $this->assertEquals($statusClass, $result);
    }

    public function test_should_return_exception_when_update_status()
    {
        $statusDTO = StatusResource::returnStatusDTO();
        $statusDTO->idStatus = 1;

        $instanceClass = $this->instanceUpdateStatusService();

        $this->statusValidationMock
            ->method('choseIsValid')
            ->with($statusDTO->idStatus)
            ->willThrowException(new StatusException(
                SystemMessagesEnum::DELETE_NOT_POSSIBLE,
                Response::HTTP_BAD_REQUEST
            ));

        $this->expectException(StatusException::class);

        $instanceClass->update($statusDTO);
    }
}