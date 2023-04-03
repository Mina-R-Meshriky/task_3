<?php

namespace App\Core;

class SimpleResponse
{

    public const OK = 200;
    public const NOTFOUND = 404;
    public const BAD_REQUEST = 400;
    public const METHOD_NOT_ALLOWED = 405;

    public int $code;
    public ?string $content;

    public static function make(?string $content = null, int $code = self::OK): self
    {
        return new self($content, $code);
    }

    public function __construct(?string $content = null, int $code = self::OK)
    {
        $this->code = $code;
        $this->content = $content;
    }

    public function send(): void
    {
        $this->applyHeader();
        $this->applyContent();
        die;
    }

    private function applyHeader()
    {
        http_response_code($this->code);
    }

    private function applyContent()
    {
        if (!$this->content) {
            return;
        }

        echo $this->content;
    }

}