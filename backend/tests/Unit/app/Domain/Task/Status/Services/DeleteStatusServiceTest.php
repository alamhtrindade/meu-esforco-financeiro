<?php

namespace Tests\Unit\app\Domain\Task\Status\Services;

use App\Application\Enums\SystemMessagesEnum;
use App\Domain\Task\Status\Contracts\DeleteStatusRepositoryInterface;
use App\Domain\Task\Status\Contracts\UpdateStatusRepositoryInterface;
use App\Domain\Task\Status\Exceptions\StatusException;
use App\Domain\Task\Status\Services\DeleteStatusService;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Task\Status\Services\UpdateStatusService;
use App\Domain\Task\Status\Validations\StatusValidation;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Status\Resources\StatusResource;

class DeleteStatusServiceTest extends TestCase
{
    private MockObject|DeleteStatusRepositoryInterface $deleteStatusRepositoryMock;
    private MockObject|StatusValidation $statusValidationMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteStatusRepositoryMock = $this->createMock(DeleteStatusRepositoryInterface::class);
        $this->statusValidationMock = $this->createMock(StatusValidation::class);
    }

    public function instanceDeleteStatusService()
    {
        return new DeleteStatusService(
            $this->deleteStatusRepositoryMock,
            $this->statusValidationMock
        );
    }

    public function test_should_return_success_when_delete_status()
    {
        $statusDTO = StatusResource::returnStatusDTO();
        $statusDTO->idStatus = 3;

        $instanceClass = $this->instanceDeleteStatusService();

        $this->statusValidationMock
            ->expects($this->once())
            ->method('choseIsValid')
            ->with($statusDTO->idStatus);

        $this->deleteStatusRepositoryMock
            ->expects($this->once())
            ->method('delete')
            ->with($statusDTO->idStatus);

        $instanceClass->delete($statusDTO->idStatus);
    }

    public function test_should_return_exception_when_delete_status()
    {
        $statusDTO = StatusResource::returnStatusDTO();
        $statusDTO->idStatus = 1;

        $instanceClass = $this->instanceDeleteStatusService();

        $this->statusValidationMock
            ->method('choseIsValid')
            ->with($statusDTO->idStatus)
            ->willThrowException(new StatusException(
                SystemMessagesEnum::DELETE_NOT_POSSIBLE,
                Response::HTTP_BAD_REQUEST
            ));

        $this->expectException(StatusException::class);

        $instanceClass->delete($statusDTO->idStatus);
    }
}