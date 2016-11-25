<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

use Slim\Container;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'amazon_search_endpoint' => 'https://www.amazon.com/s/',
        'amazon_search_keyword_parameter' => 'field-keywords'
    ],
];

$c = new Container($configuration);

$app = new App($c);

$container = $app->getContainer();

$container["amazonProductService"] = function($c) {
    return new \Slidely\Service\AmazonProductService($c['settings']['amazon_search_endpoint'],
                                                     $c['settings']['amazon_search_keyword_parameter']);
};

$app->get('/api/product-search', function (Request $request, Response $response) {

    $params = $request->getQueryParams();

    $keyword = $params['keyword'];

    /** @var \Slidely\Service\AmazonProductService $amazonProductService */
    $amazonProductService = $this->amazonProductService;

    $productResponse = $amazonProductService->getFirstProduct($keyword);

    return $response->withJson($productResponse->jsonSerialize());
});
$app->run();