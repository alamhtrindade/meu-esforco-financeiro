<?php

namespace App\Application\Requests;

use App\Application\Enums\ArrayKeysEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends LaravelFormRequest
{

    abstract public function rules();
    abstract public function authorize();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        Log::error('Erro na Requisição: ', $errors);
        throw new HttpResponseException(
            response()->json([ArrayKeysEnum::ERROR => $errors], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
