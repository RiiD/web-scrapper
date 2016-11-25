<?php

namespace Slidely\WebScrapper;

class AmazonFirstProductScrapper extends AmazonProductScrapper {

    /**
     * Extracts data from given page and returns it.
     *
     * @return mixed
     */
    public function getData() {
        $pageDom = \phpQuery::newDocument($this->page);

        $productDom = $pageDom->find('li#result_0');

        return $this->extractProductData($productDom);
    }
}