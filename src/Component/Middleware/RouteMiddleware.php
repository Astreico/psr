<?php

namespace Component\Middleware;


use Component\Router\Exception\RequestNotMatchedException;
use Component\Router\Router;
use Psr\Http\Message\ServerRequestInterface;

class RouteMiddleware
{

    protected $router;

    protected $resolver;

    public function __construct(Router $router, MiddlewareResolver $resolver) {
        $this->router = $router;
        $this->resolver = $resolver;
    }


    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            $result = $this->router->match($request);
            foreach ($result->getAttributes() as $attribute => $value) {
                $request = $request->withAttribute($attribute, $value);
            }
            $middleware = $this->resolver->resolve($result->getHandler());
            return $middleware($request, $next);
        } catch (RequestNotMatchedException $e) {
            return $next($request);
        }
    }
}
