<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \Zend\Diactoros\ServerRequestFactory;
use \Zend\Diactoros\Response\SapiEmitter;
use \Zend\Diactoros\Response\HtmlResponse;
use \Component\Router\RouteCollection;
use \Component\Router\Router;


chdir(dirname(__DIR__));

require './vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();

$routeCollection = new RouteCollection();
$routeCollection->add('test_route', '/blog/{id}', null, ['GET']);

$router = new Router($routeCollection);

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $response = new HtmlResponse("OK");
} catch (\Component\Router\Exception\RequestNotMatchedException $e) {
    $response = new HtmlResponse("Page not found", 404);
}

$emitter = new SapiEmitter();
$emitter->emit($response);

//var_dump($request->getQuery());