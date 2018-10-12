<?php

namespace Test\Component;

use Component\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testContent()
    {
        $response = new Response('response content', 200);
        self::assertEquals('response content', $response->getContent());
    }

    public function testStatus()
    {
        $response = new Response('Page not found', 404);
        self::assertEquals(404, $response->getStatusCode());
        self::assertEquals('Not Found', $response->getReasonPhrase());
    }

    public function testHeader()
    {
        $response = new Response();
        $response->setHeader('test header', 'header-value');
        self::assertEquals('header-value', $response->getHeader('test header'));
        self::assertTrue($response->hasHeader('test header'));
    }
}
