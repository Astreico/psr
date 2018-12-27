<?php

namespace Component\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\HtmlResponse;

class NotFoundHandlerMiddleware
{

    public function __invoke()
    {
        return new HtmlResponse("Page not found", 404);
    }
}
