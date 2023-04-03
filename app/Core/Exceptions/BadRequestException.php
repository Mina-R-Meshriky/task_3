<?php

namespace App\Core\Exceptions;

use App\Core\SimpleResponse;

class BadRequestException extends \Exception
{
    public function __construct($message = "", $code = SimpleResponse::BAD_REQUEST, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}