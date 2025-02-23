<?php

namespace App\Domain\Expense\Requests;

use App\Application\Requests\BaseRequest;

class ExpenseRequest extends BaseRequest
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
            'date_expense' => $requiredDate
        ];
    }

    public function attributes(): array
    {
        return [
            'value'       => 'Valor',
            'id_person'   => 'ID Pessoa',
            'date_expense' => 'Data'
        ];
    }
}
