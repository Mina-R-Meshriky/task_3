<?php

namespace App;

use App\Core\Exceptions\BadRequestException;
use App\Core\SimpleResponse;

class AmazonController
{
    private AmazonFetch $amazonFetch;

    public function __construct(AmazonFetch $amazonFetch)
    {
        $this->amazonFetch = $amazonFetch;
    }

    public function show(array $parmas): SimpleResponse
    {
        if(empty($parmas) || !isset($parmas['url'])) {
            throw new BadRequestException('You must include a url param. to your request');
        }

        return SimpleResponse::make(json_encode(
            $this->amazonFetch
            ->setUrl($parmas['url'])
            ->getResults())
        );

    }
}