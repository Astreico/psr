<?php

namespace Component\Router;

use Component\Router\Exception\RequestNotMatchedException;
use Component\Router\Exception\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routes = [];

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(ServerRequestInterface $request): Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            $result = $route->match($request);
            if ($result) {
                return $result;
            }
        }
        throw new RequestNotMatchedException($request);
    }

    public function generate($name, $params = []): string
    {
        foreach ($this->routes->getRoutes() as $route) {
            $url = $route->generate($name, $params);
            if ($url) {
                return $url;
            }
        }
        throw new RouteNotFoundException($name, $params);
    }

}
