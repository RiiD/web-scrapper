<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

use Slim\Container;
use Slidely\WebScrapper\AmazonFirstProductScrapper;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new Container($configuration);

$app = new App($c);
$app->get('/api/product-search', function (Request $request, Response $response) {

    $params = $request->getQueryParams();

    $keyword = $params['keyword'];

    $pageContents = file_get_contents('https://www.amazon.com/s/?field-keywords=' . $keyword);
    $scrapper = new AmazonFirstProductScrapper($pageContents);


    return $response->withJson($scrapper->getData());
});
$app->run();