<?php

namespace Slidely\WebScrapper;

interface WebScrapper {

    /**
     * WebScrapper constructor. Gets page to be scrapped.
     *
     * @param string $page
     */
    public function __construct(string $page);

    /**
     * Extracts data from given page and returns it.
     *
     * @return mixed
     */
    public function getData();
}