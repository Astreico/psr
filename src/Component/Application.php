<?php
/**
 * Created by PhpStorm.
 * User: olas
 * Date: 21.10.18
 * Time: 23.34
 */

namespace Component;


use Component\Middleware\MiddlewareResolver;
use Component\Pipeline\Pipeline;
use Psr\Http\Message\ServerRequestInterface;

class Application extends Pipeline
{
    /**
     * @var MiddlewareResolver
     */
    private $resolver;
    /**
     * @var callable
     */
    private $default;

    public function __construct(MiddlewareResolver $resolver, callable $default)
    {
        parent::__construct();
        $this->resolver = $resolver;
        $this->default = $default;
    }

    public function pipe($middleware)
    {
        parent::pipe($this->resolver->resolve($middleware));
    }

    public function run(ServerRequestInterface $request)
    {
        return $this($request, $this->default);
    }
}