<?php

namespace App\Application\Enums;

use Illuminate\Validation\Rules\Enum;

final class HttpRequestMethodsEnum extends Enum
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';
}
