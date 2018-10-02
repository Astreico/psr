<?php

namespace Component\Http;

class Request
{
    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getParsedBody(): array
    {
        return $_POST ?? [];
    }

    public function getBody()
    {
        return file_get_contents('php://input');
    }
}