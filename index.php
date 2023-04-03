<?php

require "./vendor/autoload.php";

set_exception_handler(function ($e) {
    if ($e instanceof Exception) {
        \App\Core\SimpleExceptionHandler::handle($e);
    }
   throw $e;
});

$router = new \App\Core\SimpleRouter($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

$router
    ->serve()
    ->send();