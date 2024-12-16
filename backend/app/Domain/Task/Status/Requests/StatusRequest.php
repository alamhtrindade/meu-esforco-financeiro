<?php

namespace App\Domain\Task\Status\Requests;

use App\Application\Requests\BaseRequest;

class StatusRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredStringMax = 'required|string|max:20';
        $integer = 'integer';
        
        return [
            'name'     => $requiredStringMax,
            'idStatus' => $integer
        ];
    }

    public function attributes(): array
    {
        return [
            'idStatus' => 'Id Status',
            'name'     => 'Nome'
        ];
    }
}