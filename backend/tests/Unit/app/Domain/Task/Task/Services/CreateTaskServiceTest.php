<?php

namespace Tests\Unit\app\Domain\Task\Task\Services;

use App\Application\Enums\SystemMessagesEnum;
use PHPUnit\Framework\MockObject\MockObject;
use App\Domain\Task\Task\Contracts\CreateTaskRepositoryInterface;
use App\Domain\Task\Task\Exceptions\TaskException;
use App\Domain\Task\Task\Services\CreateTaskService;
use App\Domain\Task\Task\Validations\TaskValidation;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Unit\app\Domain\Task\Task\Resources\TaskResource;

class CreateTaskServiceTest extends TestCase
{
    private MockObject|CreateTaskRepositoryInterface $createTaskRepositoryMock;
    private MockObject|TaskValidation $taskValidationMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTaskRepositoryMock = $this->createMock(CreateTaskRepositoryInterface::class);
        $this->taskValidationMock       = $this->createMock(TaskValidation::class);
    }

    public function instanceCreateTaskService()
    {
        return new CreateTaskService(
            $this->createTaskRepositoryMock,
            $this->taskValidationMock
        );
    }

    public function test_should_return_success_when_create_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskClass = TaskResource::returnTask();

        $instanceClass = $this->instanceCreateTaskService();

        $this->taskValidationMock
            ->method('dateIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->endDate
            );

        $this->createTaskRepositoryMock
            ->method('create')
            ->willReturn($taskClass);

        $result = $instanceClass->create($taskDTO);

        $this->assertEquals($taskClass, $result);
    }
    
    public function test_should_erro_date_before_today_when_create_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->endDate = '2024/12/13';

        $instanceClass = $this->instanceCreateTaskService();

        $this->taskValidationMock
            ->method('dateIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->endDate
            )
            ->willThrowException(new TaskException(
                SystemMessagesEnum::CHOSEN_DATE_BEFORE_TODAY,
                Response::HTTP_BAD_REQUEST
            ));
        
        $this->expectException(TaskException::class);

        $instanceClass->create($taskDTO);
    }

    public function test_should_erro_invalid_date_when_create_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->startDate = '2024/12/16';
        $taskDTO->endDate = '2024/12/15';

        $instanceClass = $this->instanceCreateTaskService();

        $this->taskValidationMock
            ->method('dateIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->endDate
            )
            ->willThrowException(new TaskException(
                SystemMessagesEnum::END_IS_BEFOR_START,
                Response::HTTP_BAD_REQUEST
            ));
        
        $this->expectException(TaskException::class);

        $instanceClass->create($taskDTO);
    }
}