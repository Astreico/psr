<?php

namespace Component\Router;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function add($name, $pattern, $handler, $methods, array $tokens = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, $methods, $tokens);
    }

    /**
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
