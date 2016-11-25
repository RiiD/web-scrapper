<?php

namespace Slidely\WebScrapper;

class AmazonFirstProductScrapper extends AmazonProductScrapper {

    /**
     * Extracts data from given page and returns it. Null if not found.
     *
     * @return array | null
     */
    public function getData() {
        $pageDom = \phpQuery::newDocument($this->page);

        $productDom = $pageDom->find('li#result_0');

        if($productDom->length > 0) {
            return $this->extractProductData($productDom);
        } else {
            return null;
        }
    }
}