<?php

namespace Tests\Unit\app\Domain\Task\Task\Services;

use App\Application\Enums\SystemMessagesEnum;
use PHPUnit\Framework\MockObject\MockObject;
use App\Domain\Task\Task\Contracts\UpdateTaskRepositoryInterface;
use App\Domain\Task\Task\Exceptions\TaskException;
use App\Domain\Task\Task\Services\UpdateTaskService;
use App\Domain\Task\Task\Validations\TaskValidation;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\Unit\app\Domain\Task\Task\Resources\TaskResource;

class UpdateTaskServiceTest extends TestCase
{
    private MockObject|UpdateTaskRepositoryInterface $updateTaskRepositoryMock;
    private MockObject|TaskValidation $taskValidationMock;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->updateTaskRepositoryMock = $this->createMock(UpdateTaskRepositoryInterface::class);
        $this->taskValidationMock       = $this->createMock(TaskValidation::class);
    }

    public function instanceUpdateTaskService()
    {
        return new UpdateTaskService(
            $this->updateTaskRepositoryMock,
            $this->taskValidationMock
        );
    }

    public function test_should_return_success_when_update_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->name = 'Novo Nome';
        $taskClass = TaskResource::returnTask();
        $taskClass->name = $taskDTO->name;

        $instanceClass = $this->instanceUpdateTaskService();

        $this->taskValidationMock
            ->method('dateIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->endDate
            );
        
        $this->taskValidationMock
            ->method('timeIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->startTime,
                $taskDTO->endTime
            );

        $this->updateTaskRepositoryMock
            ->method('update')
            ->willReturn($taskClass);

        $result = $instanceClass->update($taskDTO);

        $this->assertEquals($taskClass, $result);
    }
    
    public function test_should_erro_date_before_today_when_update_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->endDate = '2024/12/13';

        $instanceClass = $this->instanceUpdateTaskService();

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

        $instanceClass->update($taskDTO);
    }

    public function test_should_erro_invalid_date_when_update_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->startDate = '2024/12/16';
        $taskDTO->endDate = '2024/12/15';

        $instanceClass = $this->instanceUpdateTaskService();

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

        $instanceClass->update($taskDTO);
    }

    public function test_should_erro_invalid_time_when_update_task()
    {
        $taskDTO = TaskResource::returnTaskDTO();
        $taskDTO->endTime = '01:00:00';

        $instanceClass = $this->instanceUpdateTaskService();

        $this->taskValidationMock
            ->method('dateIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->endDate
            );
        
        $this->taskValidationMock
            ->method('timeIsValid')
            ->with(
                $taskDTO->startDate,
                $taskDTO->startTime,
                $taskDTO->endTime
            )
            ->willThrowException(new TaskException(
                SystemMessagesEnum::CHOSEN_END_TIME_BEFORE_START_TIME,
                Response::HTTP_BAD_REQUEST
            ));

        $this->expectException(TaskException::class);

        $instanceClass->update($taskDTO);
    }
}