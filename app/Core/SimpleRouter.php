<?php

namespace App\Core;

use App\AmazonController;
use App\AmazonFetch;
use App\Core\Exceptions\MethodNotAllowed;
use App\Core\Exceptions\NotFoundException;

class SimpleRouter
{
    private string $method;
    private string $url;

    public function __construct(string $requestUrl, string $method) {
        $this->method = $method;

        $params = parse_url($requestUrl);
        $this->url = $params['path'];
    }

    /**
     * In the serve method I am only supporting GET requests
     *
     * @return void
     * @throws \Exception
     */
    public function serve(): SimpleResponse {

        if($this->method != 'GET') {
            throw new MethodNotAllowed();
        }

        switch ($this->url) {
            case "/": return SimpleResponse::make(json_encode([
                'code' => SimpleResponse::OK,
                'message' => 'this is the home page, please visit /amazon?url=... for the task assignment',
                'examples' => [
                    "http://localhost:8000/amazon?url=https://www.amazon.eg/-/en/DOLCE-GABBANA-LIGHT-INTENSE-100ML/dp/B072Q4GJLT",
                    "http://localhost:8000/amazon?url=https://www.amazon.eg/-/en/Screen-TV-AV-Player-NS-701-2724308580313/dp/B099N33NWY",
                    ]
            ]));
            case "/amazon": return (new AmazonController(new AmazonFetch))->show($_GET);
            default: throw new NotFoundException();
        }

    }
}