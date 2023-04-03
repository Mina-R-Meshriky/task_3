<?php

namespace App\Core\Exceptions;

use App\Core\SimpleResponse;

class MethodNotAllowed extends \Exception
{
    public function __construct($message = "", $code = SimpleResponse::METHOD_NOT_ALLOWED,  $previous = null)
    {
        parent::__construct($_SERVER['REQUEST_METHOD']. " is Not Allowed for this route", $code, $previous);
    }
}