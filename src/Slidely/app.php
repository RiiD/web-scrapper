<?php

namespace Slidely;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slidely\Exception\NotFoundException;
use Slidely\Service\AmazonProductService;
use Slim\App;

use Slim\Container;

define('SETTINGS', 'settings');

$configuration = [
    SETTINGS => [
        'displayErrorDetails' => true,
        'amazon_search_endpoint' => 'https://www.amazon.com/s/',
        'amazon_search_keyword_parameter' => 'field-keywords'
    ],
];

$c = new Container($configuration);

$app = new App($c);

$container = $app->getContainer();

$container["amazonProductService"] = function($c) {
    return new AmazonProductService($c[SETTINGS]['amazon_search_endpoint'],
                                    $c[SETTINGS]['amazon_search_keyword_parameter']);
};

$app->get('/api/product-search', function (Request $request, Response $response) {

    $params = $request->getQueryParams();

    $keyword = $params['keyword'] ?? null;

    /** @var AmazonProductService $amazonProductService */
    $amazonProductService = $this->amazonProductService;

    if ($keyword === null) {
        return $response->withStatus(400, 'Bad request: `keyword` parameter is required.');
    }

    try {
        $productResponse = $amazonProductService->getFirstProduct($keyword);
        return $response->withJson($productResponse->jsonSerialize());
    }catch (NotFoundException $e) {
        return $response->withStatus(404);
    }

});
$app->run();