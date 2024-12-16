<?php

namespace App\Application\Exceptions;

use App\Application\Enums\ArrayKeysEnum;
use Exception;
use Throwable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            ArrayKeysEnum::ERROR => $this->getMessage(),
        ], $this->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
