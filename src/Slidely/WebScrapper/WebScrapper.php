<?php

namespace Slidely\WebScrapper;

interface WebScrapper {

    /**
     * WebScrapper constructor. Gets page to be scrapped.
     *
     * @param \phpQueryObject $dom
     */
    public function __construct(\phpQueryObject $dom);

    /**
     * Extracts data from given page and returns it.
     *
     * @return mixed
     */
    public function getData();
}