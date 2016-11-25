<?php

namespace Slidely\Service;

use Slidely\Exception\NotFoundException;
use Slidely\Model\AmazonProductResponse;
use Slidely\WebScrapper\AmazonFirstProductScrapper;

class AmazonProductService {

    private $amazonSearchEndpoint;
    private $amazonKeywordParameter;

    public function __construct(string $amazonSearchEndpoint, string $amazonKeywordParameter) {
        $this->amazonSearchEndpoint = $amazonSearchEndpoint;
        $this->amazonKeywordParameter = $amazonKeywordParameter;
    }

    /**
     * Retrieves first product from Amazon search page by given keyword. Returns null if no product found.
     *
     * @param string $keyword
     *
     * @return AmazonProductResponse
     * @throws NotFoundException
     */
    public function getFirstProduct(string $keyword): AmazonProductResponse {
        $url = join([$this->amazonSearchEndpoint, '?',
                     $this->amazonKeywordParameter, '=', $keyword]);

        $page = file_get_contents($url);

        $scrapper = new AmazonFirstProductScrapper(\phpQuery::newDocument($page));
        $data = $scrapper->getData();

        if($data === null) {
            throw new NotFoundException();
        }

        $product = new AmazonProductResponse($keyword);
        $product->setName($data['name']);
        $product->setRating($data['rating']);
        $product->setFullPrice($data['full_price']);
        $product->setLastPrice($data['last_price']);
        return $product;
    }
}