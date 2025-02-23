<?php

namespace App\Domain\Income\Requests;

use App\Application\Requests\BaseRequest;

class IncomeRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredFlot  = 'required|numeric|decimal:2';
        $requiredInt   = 'required|integer';
        $requiredDate = 'required|date';
        
        return [
            'value' => $requiredFlot,
            'id_person' => $requiredInt,
            'date_income' => $requiredDate
        ];
    }

    public function attributes(): array
    {
        return [
            'value'       => 'Valor',
            'id_person'   => 'ID Pessoa',
            'date_income' => 'Data'
        ];
    }
}
