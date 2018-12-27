<?php

namespace Component\Pipeline;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Pipeline
{
    protected $queue;

    public function __construct()
    {
        $this->queue = New \SplQueue();
    }

    public function pipe($middleware)
    {
        $this->queue->enqueue($middleware);
    }

    public function __invoke(ServerRequestInterface $request, callable $default): ResponseInterface
    {
        return $this->next($request, $default);
    }

    public function next(ServerRequestInterface $request, callable $default): ResponseInterface
    {
        if ($this->queue->isEmpty()) {
            return $default($request);
        }

        $current = $this->queue->dequeue();
        return $current($request, function (ServerRequestInterface $request) use ($default) {
            return $this->next($request, $default);
        });
    }
}