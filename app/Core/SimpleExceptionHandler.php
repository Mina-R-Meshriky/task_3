<?php

namespace App\Core;

class SimpleExceptionHandler
{
    public static function handle(\Exception $e)
    {
        if ($e->getCode() != 500) {
            SimpleResponse::make(json_encode([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            ]), $e->getCode())->send();
        }

        throw $e;
    }
}