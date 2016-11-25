<?php

namespace Slidely\WebScrapper;

class AmazonFirstProductScrapper extends AmazonProductScrapper {

    /**
     * Extracts data from given page and returns it. Null if not found.
     *
     * @return array | null
     */
    public function getData() {

        $productDom = $this->dom->find('li#result_0');

        if($productDom->length > 0) {
            return $this->extractProductData($productDom);
        } else {
            return null;
        }
    }
}