<?php

namespace App\Domain\Task\Task\Exceptions;

use App\Application\Exceptions\BaseException;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class TaskException extends BaseException
{
    private $_options;

    public function __construct(
        $message,
        $code = Response::HTTP_FORBIDDEN,
        Exception $previous = null,
        $options = []
    ) {

        parent::__construct($message, $code, $previous);

        $this->_options = $options;
    }

    public function getOptions()
    {
        return $this->_options;
    }
}