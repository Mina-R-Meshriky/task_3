<?php

namespace App;


use App\Core\Exceptions\CouldNotFetchException;

class AmazonFetch
{
    private string $url;
    private string $html = '';
    private array $results;

    // since the requests are dynamic then there is no need for the constants
    const URL = '';
    const STATUS = '';
    const RESULTS = '';

    protected function fetch(): void
    {
        $data = file_get_contents($this->url);

        if ($data === false) {
            throw new CouldNotFetchException();
        };

        $this->html = str_replace(["\n", "\r", "\r\n"], " ", $data);
    }

    protected function parse(): array
    {
        return [
            'title' => $this->titleParser(),
            'description' => $this->descriptionParser(),
            'price' => $this->priceParser(),
            'reviewsCount' => $this->reviewsCountParser(),
            'images' => $this->imagesParser()
        ];
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }


    // Not sure what to use this function for
    public function setResults()
    {

    }

    public function getResults(): array
    {
        $this->fetch();

        $this->results = $this->parse();

        return $this->results;
    }


    // status will always be set from the simpleResponse Class not from here
    public function setStatus() { }

    public function getStatus() { }


    private function titleParser(): ?string
    {
        preg_match("/<span id=\"productTitle\"(.*?)>(.*?)<\/span>/", $this->html, $title);

        return isset($title[2])
            ? trim($title[2])
            : null;
    }

    private function descriptionParser(): ?string
    {
        preg_match("/<div id=\"productDescription\"(.*?)<span>(.*?)<\/span>/", $this->html, $description);

        return isset($description[2])
            ? trim($description[2])
            : null;
    }

    public function priceParser(): ?string
    {
        preg_match("/\"displayPrice\":\"(.*?)\"/", $this->html, $price);

        return isset($price[1])
            ? trim($price[1])
            : null;
    }

    private function reviewsCountParser(): ?int
    {
        preg_match("/<span id=\"acrCustomerReviewText\"(.*?)>(.*?)<\/span>/", $this->html, $reviews);

        return isset($reviews[2])
            ? (int) trim(str_replace(["ratings", ','], "", $reviews[2]))
            : null;
    }

    private function imagesParser(): ?array
    {
        preg_match("/'colorImages':(.*?)'colorToAsin'/", $this->html, $img);

        $images = json_decode(str_replace('\'', '"', trim($img[1], " \t\n\r\0\x0B,")), true);
        if ($images && isset($images['initial'])) {
            foreach ($images['initial'] as $image) {
                unset($image['main'], $image['shoppableScene']);
                $i[] = $image;
            }
        }
        return $i ?? null;
    }
}



/**
 * Add methods to above class so I can pass url field in GET parameters
 * than fetch data from amazon link, parse data and return following fields:
 * - Product Title
 * - Product Description
 * - Product Price
 * - Product Images
 * - Product Reviews Count
 * Result can be displayed as HTML or just output as array/object.
 * Also make sure to handle errors and return error message as required.
 *
 * Do not use any additional libraries or packages other than built in
 * PHP methods and classes.
 */