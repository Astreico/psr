<?php

namespace Component\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;

class ProfilerMiddleware
{

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $start = microtime();
        /** @var  ResponseInterface $response */
        $response = $next($request);
        $end = microtime();
        return $response->withHeader('Profiler-time', $end - $start);
    }
}
