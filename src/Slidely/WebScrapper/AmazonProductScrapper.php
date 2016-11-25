<?php

namespace Slidely\WebScrapper;

abstract class AmazonProductScrapper implements WebScrapper {

    protected $page;

    /**
     * WebScrapper constructor. Gets page to be scrapped.
     *
     * @param string $page
     */
    public function __construct(string $page) {
        $this->page = \phpQuery::newDocument($page);
    }

    /**
     * Extract product name from product sub DOM.
     *
     * @param \phpQueryObject $productDom
     *
     * @return string
     */
    protected function extractProductName(\phpQueryObject $productDom): string {
        return $productDom->find('h2')->html();
    }

    /**
     * Extract product rating from product sub DOM.
     *
     * @param \phpQueryObject $productDom
     *
     * @return float
     */
    protected function extractProductRating(\phpQueryObject $productDom): float {
        return (float) substr($productDom->find('i.a-icon.a-icon-star>span.a-icon-alt')->html(), 0, 3);
    }

    /**
     * Extract product full price from product sub DOM.
     *
     * @param \phpQueryObject $productDom
     *
     * @return float
     */
    protected function extractProductFullPrice(\phpQueryObject $productDom): float {
        $priceDom = $productDom->find('span.a-text-strike');
        $price = substr($priceDom->html(), 1);
        return (float) $price;
    }

    /**
     * Extract product last price from product sub DOM.
     *
     * @param \phpQueryObject $productDom
     *
     * @return float
     */
    protected function extractProductLastPrice(\phpQueryObject $productDom): float {
        $priceDom = $productDom->find('span.sx-price');
        $price = $priceDom->find('span.sx-price-whole')->html() .
                 '.' .
                 $priceDom->find('span.sx-price-fractional')->html();
        return (float) $price;
    }

    /**
     * Extracts product name, rating, full price and last price from product sub DOM.
     * Returns data in array.
     *
     * Example output:
     * ['name' => 'IPhone 6', 'rating' => 4.5, 'full_price' => 500.00, 'last_price' => 400.00]
     *
     * @param \phpQueryObject $productDom
     *
     * @return array
     */
    protected function extractProductData(\phpQueryObject $productDom): array {
        return [
            'name' => $this->extractProductName($productDom),
            'full_price' => $this->extractProductFullPrice($productDom),
            'last_price' => $this->extractProductLastPrice($productDom),
            'rating' => $this->extractProductRating($productDom)
        ];
    }
}