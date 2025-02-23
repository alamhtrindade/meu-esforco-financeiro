<?php

namespace App\Domain\Person\Requests;

use App\Application\Requests\BaseRequest;

class PersonRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredStringMax = 'required|string|max:150';
        $requiredInt = 'required|integer';
        
        return [
            'name' => $requiredStringMax,
            'nif'  => $requiredInt
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nome',
            'nif'  => 'NIF'
        ];
    }
}