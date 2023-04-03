<?php

namespace App\Core\Exceptions;

use App\Core\SimpleResponse;

class NotFoundException extends \Exception
{
    public function __construct($message = "We cant find the page you are looking for", $code = SimpleResponse::NOTFOUND, $previous = null)
    {
        parent::__construct($message, $code, $previous);

    }
}