<?php

namespace App\Core\Exceptions;

use App\Core\SimpleResponse;

class CouldNotFetchException extends \Exception
{
    public function __construct($message = "We where not able to fetch the data from the specified link", $code = SimpleResponse::BAD_REQUEST, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}