<?php

namespace Test\Component;

use Component\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testEmpty()
    {
        $request = Request::createFromGlobals();
        self::assertEquals([], $request->getQuery());
        self::assertEquals([], $request->getBody());
    }

    public function testInitialize()
    {
        $request = Request::createFromGlobals(['query' => 'value'], ['body' => 'value']);
        self::assertEquals(['query' => 'value'], $request->getQuery());
        self::assertEquals(['body' => 'value'], $request->getBody());
    }
}
