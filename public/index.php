<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Controller\IndexController;
use Component\Application;
use Component\Container\Container;
use Component\Middleware\BasicAuthMiddleware;
use Component\Middleware\MiddlewareResolver;
use Component\Pipeline\Pipeline;
use Psr\Http\Message\ServerRequestInterface;
use \Zend\Diactoros\ServerRequestFactory;
use \Zend\Diactoros\Response\SapiEmitter;
use \Zend\Diactoros\Response\HtmlResponse;
use \Component\Router\RouteCollection;
use \Component\Router\Router;

chdir(dirname(__DIR__));

require './vendor/autoload.php';

$request = ServerRequestFactory::fromGlobals();
/** @var Container $container */
$container = require './config/container.php';
$twigLoader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($twigLoader);

$routeCollection = new RouteCollection();
$routeCollection->add('test_route', '/blog/{id}', \App\Controller\BlogController::class, ['GET']);
$routeCollection->add('index', '/', [
    new BasicAuthMiddleware($container->get('auth')['users']),
    new IndexController($twig)
], ['GET']);

$router = new Router($routeCollection);
$middlewareResolver = new MiddlewareResolver();
$app = new Application($middlewareResolver, new \Component\Middleware\NotFoundHandlerMiddleware());
$app->pipe(\Component\Middleware\ProfilerMiddleware::class);
$app->pipe(new \Component\Middleware\RouteMiddleware($router, $middlewareResolver));

$response = $app->run($request);

$emitter = new SapiEmitter();
$emitter->emit($response);
