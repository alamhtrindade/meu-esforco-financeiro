<?php

namespace App\Domain\Task\Task\Requests;

use App\Application\Requests\BaseRequest;

class TaskRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredStringMax = 'required|string|max:255';
        $requiredString = 'required|string';
        $requiredInt = 'required|integer';
        $integer = 'integer';
        $string = 'string';
        
        return [
            'id'          => $integer,
            'name'        => $requiredStringMax,
            'description' => $requiredString,
            'priority'    => $requiredInt,
            'status'      => $integer,
            'startDate'   => $string,
            'endDate'     => $string,
            'startTime'   => $string,
            'endTime'     => $string,
        ];
    }

    public function attributes(): array
    {
        return [
            'id'      => 'Id Tarefa',
            'name'        => 'Nome',
            'description' => 'Descrição',
            'priority'    => 'Prioridade',
            'status'      => 'Status',
            'startDate'   => 'Data Inicial',
            'endDate'     => 'Data Final',
            'startTime'   => 'Hora Inicial',
            'endTime'     => 'Hora Final'
        ];
    }
}