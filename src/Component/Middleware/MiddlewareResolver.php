<?php

namespace Component\Middleware;


use Component\Pipeline\Pipeline;
use Psr\Http\Message\ServerRequestInterface;

class MiddlewareResolver
{
    public function resolve($handler)
    {
        if (is_array($handler)) {
            return $this->createPipeline($handler);
        }

        if (is_string($handler)) {
            return function (ServerRequestInterface $request, callable $next) use ($handler) {
                $object = new $handler();
                return $object($request, $next);
            };
        }
        return $handler;
    }

    public function createPipeline(array $handler)
    {
        $pipeline = new Pipeline();
        foreach ($handler as $item) {
            $pipeline->pipe($this->resolve($item));
        }
        return $pipeline;
    }
}
